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
        return $this->sendResponse($this->service->getAll(), 'Inventory retrieved successfully.');
    }

    public function show($id)
    {
        return $this->sendResponse($this->service->getById($id), 'Inventory retrieved successfully.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'store_id' => 'required|exists:stores,id',
            'quantity' => 'required|integer|min:0',
        ]);

        return $this->sendResponse($this->service->create($data), 'Inventory created successfully.');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        return $this->sendResponse($this->service->update($id, $data), 'Inventory updated successfully.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return $this->sendResponse([], 'Inventory deleted successfully.');
    }
}
