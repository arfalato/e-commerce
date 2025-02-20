<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use  App\Service\OrderService;

class OrdersController extends BaseController
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    #[Route('/orders', methods: ['POST'])]
    public function createOrder(Request $request): JsonResponse|Response
    {
        try {
            $content = json_decode($request->getContent(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return new Response('Invalid JSON format', Response::HTTP_BAD_REQUEST);
            }

            $order = $this->orderService->createOrder($content);

            return new JsonResponse($order->getId(), Response::HTTP_CREATED);

        } catch (Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/orders/{id}', methods: ['GET'])]
    public function getOrder(int $id): JsonResponse|Response
    {
        try {
            $order = $this->orderService->getOrder($id);
            return new JsonResponse($order, Response::HTTP_OK);

        } catch (Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    #[Route('/orders/{id}', methods: ['DELETE'])]
    public function deleteOrder(int $id): JsonResponse|Response
    {
        try {
            $this->orderService->deleteOrder($id);
            return new Response(null, Response::HTTP_NO_CONTENT);

        } catch (Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    #[Route('/orders/{id}', methods: ['PUT'])]
    public function updateOrder(int $id, Request $request): JsonResponse|Response
    {
        try {
            $content = json_decode($request->getContent(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return new Response('Invalid JSON format', Response::HTTP_BAD_REQUEST);
            }

            $order = $this->orderService->updateOrder($id, $content);

            return new JsonResponse($order, Response::HTTP_OK);

        } catch (Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/orders', methods: ['GET'])]
    public function getOrders(Request $request): JsonResponse|Response
    {
        $name = $request->query->get('name');
        $description = $request->query->get('description');
        $date = $request->query->get('date');
        $params = [
            'name' => $name,
            'description' => $description,
            'date' => $date
        ];

        if (count(array_filter($params)) === 0) {
            $params = [];
        }
        try {
            $orders = $this->orderService->getOrders($params);
            return new JsonResponse($orders, Response::HTTP_OK);

        } catch (Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}