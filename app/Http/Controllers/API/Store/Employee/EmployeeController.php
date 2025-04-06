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
        return response()->json($this->employeeService->getAll());
    }

    public function show($id)
    {
        return response()->json($this->employeeService->getById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|max:20',
            'role_id' => 'required|exists:roles,id',
        ]);

        return response()->json($this->employeeService->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:employees,email,'.$id,
            'phone' => 'sometimes|string|max:20',
            'role_id' => 'sometimes|exists:roles,id',
        ]);

        return response()->json($this->employeeService->update($id, $data));
    }

    public function destroy($id)
    {
        $this->employeeService->delete($id);

        return response()->json(['message' => 'Employee deleted']);
    }
}
