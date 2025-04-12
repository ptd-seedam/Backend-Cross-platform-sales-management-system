<?php

namespace App\Http\Controllers\Api\Store\Warehouse;

use App\Http\Controllers\API\BaseController;
use App\Services\Warehouse\WarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends BaseController
{
    protected $service;

    public function __construct(WarehouseService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->sendResponse($this->service->getAll(), 'Warehouses retrieved successfully.');
    }

    public function show($id)
    {
        return $this->sendResponse($this->service->getById($id), 'Warehouse retrieved successfully.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'store_id' => 'required|exists:stores,id',
        ]);

        return $this->sendResponse($this->service->create($data), 'Warehouse created successfully.', 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string',
        ]);

        return $this->sendResponse($this->service->update($id, $data), 'Warehouse updated successfully.');

    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return $this->sendResponse([], 'Warehouse deleted successfully.');
    }
}
