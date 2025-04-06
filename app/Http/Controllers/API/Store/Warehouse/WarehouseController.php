<?php

namespace App\Http\Controllers\Api;

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
        return response()->json($this->service->getAll());
    }

    public function show($id)
    {
        return response()->json($this->service->getById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'store_id' => 'required|exists:stores,id',
        ]);

        return response()->json($this->service->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string',
        ]);

        return response()->json($this->service->update($id, $data));
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Warehouse deleted']);
    }
}
