<?php


namespace App\Tests\Controller;

use App\Controller\OrdersController;
use App\Service\OrderService;
use App\Entity\Order;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class OrdersControllerTest extends TestCase
{
    private OrderService $orderService;
    private OrdersController $controller;

    protected function setUp(): void
    {
        $this->orderService = $this->createMock(OrderService::class);
        $this->controller = new OrdersController($this->orderService);
    }

    public function testCreateOrderSuccess(): void
    {
        $orderData = [
            'product_id' => 1,
            'quantity' => 2
        ];


        $mockOrder = $this->createMock(Order::class);
        $mockOrder->method('getId')
            ->willReturn(12345);


        $this->orderService
            ->expects($this->once())
            ->method('createOrder')
            ->with($orderData)
            ->willReturn($mockOrder);


        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            [],
            json_encode($orderData)
        );


        $response = $this->controller->createOrder($request);


        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals('12345', $response->getContent());
    }

    public function testCreateOrderFailure(): void
    {
        $orderData = [
            'product_id' => 1,
            'quantity' => 2
        ];


        $this->orderService
            ->expects($this->once())
            ->method('createOrder')
            ->with($orderData)
            ->willThrowException(new Exception('Invalid order data'));


        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            [],
            json_encode($orderData)
        );


        $response = $this->controller->createOrder($request);


        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Invalid order data', $response->getContent());
    }

    public function testCreateOrderInvalidJson(): void
    {

        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            [],
            '{invalid json'
        );


        $response = $this->controller->createOrder($request);


        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());
    }


    public function testGetOrderNotFound(): void
    {

        $orderId = 999;
        $errorMessage = 'Order not found';

        $this->orderService
            ->expects($this->once())
            ->method('getOrder')
            ->with($orderId)
            ->willThrowException(new Exception($errorMessage));


        $response = $this->controller->getOrder($orderId);

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertEquals($errorMessage, $response->getContent());
    }

    public function testGetOrderDetails()
    {
        $orderId = 1;
        $orderData = [
            'id' => 1,
            'date' => '2021-10-01',
            'name' => 'Order 1',
            'description' => 'Order 1 description',
            'totalAmount' => 160,
            'products' => [
                [
                    'id' => 1,
                    'name' => 'Product 1',
                    'quantity' => 2,
                    'price' => 50,
                ],
                [
                    'id' => 2,
                    'name' => 'Product 2',
                    'quantity' => 3,
                    'price' => 20,
                ]
            ]
        ];

        $this->orderService
            ->expects($this->once())
            ->method('getOrder')
            ->with($orderId)
            ->willReturn($orderData);

        $response = $this->controller->getOrder($orderId);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals(json_encode($orderData, true), $response->getContent());
    }

    public function testDeleteOrder(): void
    {
        $orderId = 1;

        $this->orderService
            ->expects($this->once())
            ->method('deleteOrder')
            ->with($orderId);

        $response = $this->controller->deleteOrder($orderId);
        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
    }
}