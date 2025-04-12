<?php

namespace App\Http\Controllers\Api\Store\OrderItem;

use App\Http\Controllers\API\BaseController;
use App\Services\OrderItem\OrderItemService;
use Illuminate\Http\Request;

class OrderItemController extends BaseController
{
    protected $orderItemService;

    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
    }

    public function index($orderId)
    {
        return $this->sendResponse($this->orderItemService->getAllOrderItems($orderId), 'Order items retrieved successfully.');
    }

    public function store(Request $request, $orderId)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $data['order_id'] = $orderId;

        return $this->sendResponse($this->orderItemService->createOrderItem($data), 'Order item created successfully.');
    }

    public function show($id)
    {
        return $this->sendResponse($this->orderItemService->getOrderItem($id), 'Order item retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        return $this->sendResponse($this->orderItemService->updateOrderItem($id, $request->all()), 'Order item updated successfully.');
    }

    public function destroy($id)
    {
        $this->orderItemService->deleteOrderItem($id);

        return $this->sendResponse([], 'Order item deleted successfully.');
    }
}
