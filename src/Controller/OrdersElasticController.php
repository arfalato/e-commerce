<?php

namespace App\Controller;

use Exception;
use App\Service\OrderElasticService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class OrdersElasticController extends BaseController
{
    private OrderElasticService $ordersFinder;

    public function __construct(OrderElasticService $ordersFinder)
    {
        $this->ordersFinder = $ordersFinder;
    }

    #[Route('/orders-elastic', methods: ['GET'])]
    public function searchOrders(Request $request): JsonResponse|Response
    {
        $query = $request->query->get('q', '');
        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', 10);

        try {
            $orders = $this->ordersFinder->findOrders($query, $page, $limit);
            return new JsonResponse($orders, Response::HTTP_OK);

        } catch (Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}