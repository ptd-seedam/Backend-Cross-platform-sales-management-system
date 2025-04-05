<?php

namespace App\Repositories;

use App\Interfaces\OrderItemRepositoryInterface;
use App\Models\OrderItem;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    public function all($orderId)
    {
        return OrderItem::where('order_id', $orderId)->get();
    }

    public function find($id)
    {
        return OrderItem::findOrFail($id);
    }

    public function create(array $data)
    {
        return OrderItem::create($data);
    }

    public function update($id, array $data)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->update($data);

        return $orderItem;
    }

    public function delete($id)
    {
        OrderItem::destroy($id);
    }
}
