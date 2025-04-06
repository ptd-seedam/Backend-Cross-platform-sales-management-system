<?php

namespace App\Http\Controllers\Api\Store\StoreEmployee;

use App\Http\Controllers\API\BaseController;
use App\Services\StoreEmployee\StoreEmployeeService;
use Illuminate\Http\Request;

class StoreEmployeeController extends BaseController
{
    protected $service;

    public function __construct(StoreEmployeeService $service)
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
            'employee_id' => 'required|exists:employees,id',
            'store_id' => 'required|exists:stores,id',
            'assigned_at' => 'nullable|date',
        ]);

        return response()->json($this->service->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'store_id' => 'required|exists:stores,id',
        ]);

        return response()->json($this->service->update($id, $data));
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
