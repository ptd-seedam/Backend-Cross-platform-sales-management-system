<?php

namespace App\Http\Controllers\Api\Store\Inventory;

use App\Http\Controllers\Api\BaseController;
use App\Services\Inventory\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends BaseController
{
    protected $service;

    public function __construct(InventoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show($id)
    {
        return response()->json($this->service->getById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'store_id' => 'required|exists:stores,id',
            'quantity' => 'required|integer|min:0',
        ]);

        return response()->json($this->service->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        return response()->json($this->service->update($id, $data));
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Inventory deleted']);
    }
}
