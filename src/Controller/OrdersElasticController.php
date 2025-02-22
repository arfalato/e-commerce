<?php

namespace App\Controller;

use Exception;
use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
use Elastica\Query\BoolQuery;
use Elastica\Query\MultiMatch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdersElasticController extends AbstractController
{
    private $ordersFinder;

    public function __construct(PaginatedFinderInterface $ordersFinder)
    {
        $this->ordersFinder = $ordersFinder;
    }

    #[Route('/orders-elastic', methods: ['GET'])]
    public function searchOrders(Request $request): Response
    {
        $query = $request->query->get('q', '');
        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', 10);


        $boolQuery = new BoolQuery();

        if (!empty($query)) {
            $multiMatch = new MultiMatch();
            $multiMatch->setQuery($query);
            $multiMatch->setFields([
                'id^3',
                'name',
                'description'
            ]);
            $boolQuery->addMust($multiMatch);
        }

        try {
            $paginator = $this->ordersFinder->findPaginated($boolQuery);
            $paginator->setMaxPerPage($limit);
            $paginator->setCurrentPage($page);

            $results = [
                'total' => $paginator->getNbResults(),
                'page' => $page,
                'limit' => $limit,
                'pages' => ceil($paginator->getNbResults() / $limit),
                'orders' => array_map(function ($order) {
                    return [
                        'id' => $order->getId(),
                        'date' => $order->getCreationDate()->format('Y-m-d H:i:s'),
                        'name' => $order->getName(),
                        'description' => $order->getDescription(),
                        'totalAmount' => $order->getTotalAmount(),
                        'products' => array_map(function ($item) {
                            return [
                                'id' => $item->getProduct()->getId(),
                                'name' => $item->getProduct()->getName(),
                                'quantity' => $item->getQuantity(),
                                'price' => (float)$item->getProduct()->getPrice(),
                            ];
                        }, $order->getOrderItems()->toArray())
                    ];
                }, $paginator->getCurrentPageResults())
            ];

            return $this->json($results);
        } catch (Exception $e) {
            return $this->json([
                'error' => 'Search error occurred',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}