<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function all()
    {
        return Order::with('orderItems')->get();
    }

    public function find($id)
    {
        return Order::with('orderItems')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Order::create($data);
    }

    public function update($id, array $data)
    {
        $order = Order::findOrFail($id);
        $order->update($data);

        return $order;
    }

    public function delete($id)
    {
        Order::destroy($id);
    }
}
