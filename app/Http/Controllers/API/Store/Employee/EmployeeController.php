<?php

namespace App\Http\Controllers\Api\Store\Employee;

use App\Http\Controllers\Api\BaseController;
use App\Services\Employee\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends BaseController
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        return $this->sendResponse($this->employeeService->getAll(), 'Employees retrieved successfully.');
    }

    public function show($id)
    {
        return $this->sendResponse($this->employeeService->getById($id), 'Employee retrieved successfully.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|max:20',
            'role_id' => 'required|exists:roles,id',
        ]);

        return $this->sendResponse($this->employeeService->create($data), 'Employee created successfully.');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:employees,email,'.$id,
            'phone' => 'sometimes|string|max:20',
            'role_id' => 'sometimes|exists:roles,id',
        ]);

        return $this->sendResponse($this->employeeService->update($id, $data), 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $this->employeeService->delete($id);

        return $this->sendResponse([], 'Employee deleted successfully.');
    }
}
