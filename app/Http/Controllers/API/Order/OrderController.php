<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        return response()->json($this->orderService->getAllOrders());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'status' => 'nullable|string',
        ]);

        return response()->json($this->orderService->createOrder($data), 201);
    }

    public function show($id)
    {
        return response()->json($this->orderService->getOrder($id));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->orderService->updateOrder($id, $request->all()));
    }

    public function destroy($id)
    {
        $this->orderService->deleteOrder($id);

        return response()->json(['message' => 'Order deleted']);
    }
}
