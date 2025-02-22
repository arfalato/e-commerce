<?php

namespace App\Service;

use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
use Elastica\Query\BoolQuery;
use Elastica\Query\MultiMatch;

class OrderElasticService
{
    private $ordersFinder;

    public function __construct(PaginatedFinderInterface $ordersFinder)
    {
        $this->ordersFinder = $ordersFinder;
    }

    public function findOrders(string $query, int $page, int $limit): array
    {
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

        $paginator = $this->ordersFinder->findPaginated($boolQuery);
        $paginator->setMaxPerPage($limit);
        $paginator->setCurrentPage($page);

        return [
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
    }
}