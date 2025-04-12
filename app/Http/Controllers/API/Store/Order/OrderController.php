<?php

namespace App\Http\Controllers\Api\Store\Order;

use App\Http\Controllers\API\BaseController;
use App\Services\Order\OrderService;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        return $this->sendResponse($this->orderService->getAllOrders(), 'Orders retrieved successfully.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'status' => 'nullable|string',
        ]);

        return $this->sendResponse($this->orderService->createOrder($data), 'Order created successfully.');
    }

    public function show($id)
    {
        return $this->sendResponse($this->orderService->getOrder($id), 'Order retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        return $this->sendResponse($this->orderService->updateOrder($id, $request->all()), 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $this->orderService->deleteOrder($id);

        return $this->sendResponse([], 'Order deleted successfully.');
    }
}
