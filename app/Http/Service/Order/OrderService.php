<?php

namespace App\Services\Order;

use App\Interfaces\OrderRepositoryInterface;

class OrderService
{
    protected $orderRepo;

    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function getAllOrders()
    {
        return $this->orderRepo->all();
    }

    public function getOrder($id)
    {
        return $this->orderRepo->find($id);
    }

    public function createOrder(array $data)
    {
        return $this->orderRepo->create($data);
    }

    public function updateOrder($id, array $data)
    {
        return $this->orderRepo->update($id, $data);
    }

    public function deleteOrder($id)
    {
        return $this->orderRepo->delete($id);
    }
}
