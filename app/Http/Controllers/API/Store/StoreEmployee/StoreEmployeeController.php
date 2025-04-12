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
        return $this->sendResponse($this->service->getAll(), 'Store employees retrieved successfully.');
    }

    public function show($id)
    {
        return $this->sendResponse($this->service->getById($id), 'Store employee retrieved successfully.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'store_id' => 'required|exists:stores,id',
            'assigned_at' => 'nullable|date',
        ]);

        return $this->sendResponse($this->service->create($data), 'Store employee created successfully.', 201);

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'store_id' => 'required|exists:stores,id',
        ]);

        return $this->sendResponse($this->service->update($id, $data), 'Store employee updated successfully.');

    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return $this->sendResponse([], 'Store employee deleted successfully.');

    }
}
