<?php

namespace App\Services\OrderItem;

use App\Interfaces\OrderItemRepositoryInterface;
use App\Models\Product;

class OrderItemService
{
    protected $orderItemRepo;

    public function __construct(OrderItemRepositoryInterface $orderItemRepo)
    {
        $this->orderItemRepo = $orderItemRepo;
    }

    public function getAllOrderItems($orderId)
    {
        return $this->orderItemRepo->all($orderId);
    }

    public function getOrderItem($id)
    {
        return $this->orderItemRepo->find($id);
    }

    public function updateOrderItem($id, array $data)
    {
        return $this->orderItemRepo->update($id, $data);
    }

    public function deleteOrderItem($id)
    {
        return $this->orderItemRepo->delete($id);
    }

    public function createOrderItem(array $data)
    {
        $product = Product::findOrFail($data['product_id']);

        // Kiểm tra nếu còn đủ hàng
        if ($product->stock < $data['quantity']) {
            throw new \Exception('Not enough stock');
        }

        // Cập nhật stock
        $product->decrement('stock', $data['quantity']);

        // Tính giá tiền cho OrderItem
        $data['price'] = $product->price;

        return $this->orderItemRepo->create($data);
    }
}
