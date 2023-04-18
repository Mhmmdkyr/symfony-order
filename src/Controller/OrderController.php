<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class OrderController extends ApiController
{
    private $em;
    private $serializer;
    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/order", name="order_all", methods={"GET"})
     * @return JsonResponse
     */
    public function all_orders(): JsonResponse
    {
        $repository = $this->em->getRepository(Order::class);
        $orders = $repository->findAll();
        $orderData = $this->serializer->serialize($orders, 'json');

        $response = new JsonResponse();
        $response->setContent($orderData);

        return $response;

    }

    /**
     * @Route("/api/order/show/{order_code}", name="order_show", methods={"GET"})
     * @param $order_code
     * @return JsonResponse
     */
    public function show($order_code): JsonResponse
    {
        $order = $this->em->getRepository(OrderRepository::class)->findOneBy(['order_code' => $order_code]);

        if(!$order){
            return $this->responseWithErrors("Order not found!");
        }

        $orderData = $this->serializer->serialize($order, 'json');

        $response = new JsonResponse();
        $response->setContent($orderData);

        return $response;
    }
    /**
     * @Route("/api/order/add", name="order_add", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse
    {
        $request = $this->transformJsonBody($request);
        $orderCode = $request->get('orderCode');
        $productId = $request->get('productId');
        $quantity = $request->get('quantity');
        $address = $request->get('address');

        $order = new Order;
        $order->setOrderCode($orderCode);
        $order->setProductId($productId);
        $order->setQuantity($quantity);
        $order->setAddress($address);
        $order->
        $this->em->persist($order);
        $this->em->flush();

        return $this->responseWithSuccess(sprintf('Product "%s" successfully ordered', $order->getProductId()));
    }

    /**
     * @Route("/api/order/edit/{order_code}", name="order_edit", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function update($order_code, Request $request): JsonResponse
    {
        $request = $this->transformJsonBody($request);
        $order = $this->em->getRepository(Order::class)->findOneBy(['order_code' => $order_code]);

        if(!$order){
            return $this->responseWithErrors("Order not found!");
        } elseif($order->getShippingDate()){
            return $this->responseWithErrors("The order cannot be updated at the shipping stage.");
        } else {
            $productId = $request->get('productId', $order->getProductId());
            $quantity = $request->get('quantity', $order->getQuantity());
            $address = $request->get('address', $order->getAddress());
            $shippingDate = $request->get('shippingDate', $order->getShippingDate());

            $order->setProductId($productId);
            $order->setQuantity($quantity);
            $order->setAddress($address);

            if($shippingDate){
                $shippingDate = \DateTime::createFromFormat('Y-m-d H:i:s', $shippingDate);
                $order->setShippingDate($shippingDate);
            }

            $this->em->flush();

            return $this->responseWithSuccess(sprintf('Order "%s" successfully updated!', $order->getOrderCode()));
        }
    }
}