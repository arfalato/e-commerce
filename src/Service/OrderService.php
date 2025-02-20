<?php

namespace App\Service;

use Exception;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\LockMode;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class OrderService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createOrder(array $orderData): Order
    {
        $order = new Order();
        $order->setCreationDate(new \DateTime());
        $order->setName($orderData['name']);
        $order->setDescription($orderData['description']);

        $this->entityManager->beginTransaction();

        try {
            foreach ($orderData['products'] as $productData) {
                $product = $this->entityManager->getRepository(Product::class)->find($productData['productId']);

                if (!$product) {
                    throw new NotFoundHttpException('Product not found');
                }

                $this->entityManager->lock($product, LockMode::PESSIMISTIC_WRITE);

                if ($product->getStockQuantity() < $productData['quantity']) {
                    throw new ConflictHttpException('Not enough stock available for ' . $product->getName());
                }

                $product->setStockQuantity($product->getStockQuantity() - $productData['quantity']);

                $orderItem = new OrderItem();
                $orderItem->setProduct($product);
                $orderItem->setQuantity($productData['quantity']);
                $order->addOrderItem($orderItem);


                $this->entityManager->persist($orderItem);
            }

            $this->entityManager->persist($order);
            $this->entityManager->flush();


            $this->entityManager->commit();

            return $order;
        } catch (Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }
    }

    public function getOrder(int $orderId): array
    {
        $order = $this->entityManager->getRepository(Order::class)->find($orderId);
        if (!$order) {
            throw new NotFoundHttpException('Order not found');
        }

        $orderArray = [
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
        return $orderArray;
    }

    public function deleteOrder(int $orderId): void
    {
        $order = $this->entityManager->getRepository(Order::class)->find($orderId);
        if (!$order) {
            throw new NotFoundHttpException('Order not found');
        }

        $this->entityManager->remove($order);
        $this->entityManager->flush();
    }

    public function updateOrder(int $orderId, array $orderData): int
    {
        $order = $this->entityManager->getRepository(Order::class)->find($orderId);
        if (!$order) {
            throw new NotFoundHttpException('Order not found');
        }

        $order->setName($orderData['name']);
        $order->setDescription($orderData['description']);

        $this->entityManager->persist($order);
        $this->entityManager->flush();

        $this->entityManager->beginTransaction();
        try {
            foreach ($order->getOrderItems() as $orderItem) {
                $product = $orderItem->getProduct();
                $product->setStockQuantity($product->getStockQuantity() + $orderItem->getQuantity());
                $this->entityManager->persist($product);

                $order->removeOrderItem($orderItem);
                $this->entityManager->remove($orderItem);
            }

            foreach ($orderData['products'] as $productData) {
                $product = $this->entityManager->getRepository(Product::class)->find($productData['productId']);
                if (!$product) {
                    throw new NotFoundHttpException('Product not found: ' . $productData['productId']);
                }

                $quantity = $productData['quantity'];

                $this->entityManager->lock($product, LockMode::PESSIMISTIC_WRITE);
                if ($product->getStockQuantity() < $quantity) {
                    throw new ConflictHttpException('Not enough stock available for ' . $product->getName());
                }
                $order = $this->entityManager->getRepository(Order::class)->find($orderId);

                $orderItem = new OrderItem();
                $orderItem->setProduct($product);
                $orderItem->setQuantity($quantity);
                $orderItem->setOrder($order);
                $order->addOrderItem($orderItem);

                $product->setStockQuantity($product->getStockQuantity() - $quantity);

                $this->entityManager->persist($orderItem);
                $this->entityManager->persist($product);
            }

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }

        return $order->getId();
    }

    public function getOrders(array $parameters): array
    {
        $orders = $this->entityManager->getRepository(Order::class)->findAll();
        $ordersArray = [];
        foreach ($orders as $order) {
            $ordersArray[] = [
                'id' => $order->getId(),
                'date' => $order->getCreationDate()->format('Y-m-d'),
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
        }

        if (empty($parameters)) {
            return $ordersArray;
        }

        $filters = ['name', 'description', 'date'];
        $result = array_filter($ordersArray, function ($order) use ($parameters, $filters) {
            foreach ($filters as $filter) {
                if (isset($parameters[$filter])) {
                    if ($filter === 'date') {
                        if ($order[$filter] === $parameters[$filter]) {
                            return true;
                        }
                    } else {
                        if (str_contains($order[$filter], $parameters[$filter])) {
                            return true;
                        }
                    }
                }
            }
            return false;
        });

        return $result;
    }
}

