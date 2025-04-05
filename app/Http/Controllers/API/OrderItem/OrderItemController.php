<?php

namespace App\Http\Controllers\Api;

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
        return response()->json($this->orderItemService->getAllOrderItems($orderId));
    }

    public function store(Request $request, $orderId)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $data['order_id'] = $orderId;

        return response()->json($this->orderItemService->createOrderItem($data), 201);
    }

    public function show($id)
    {
        return response()->json($this->orderItemService->getOrderItem($id));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->orderItemService->updateOrderItem($id, $request->all()));
    }

    public function destroy($id)
    {
        $this->orderItemService->deleteOrderItem($id);

        return response()->json(['message' => 'Order item deleted']);
    }
}
