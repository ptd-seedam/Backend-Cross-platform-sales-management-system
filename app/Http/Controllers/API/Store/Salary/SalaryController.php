<?php

namespace App\Http\Controllers\Api\Store\Salary;

use App\Http\Controllers\API\BaseController;
use App\Services\Salary\SalaryService;
use Illuminate\Http\Request;

class SalaryController extends BaseController
{
    protected $salaryService;

    public function __construct(SalaryService $salaryService)
    {
        $this->salaryService = $salaryService;
    }

    public function index()
    {
        return $this->sendResponse($this->salaryService->getAll(), 'Salaries retrieved successfully.');
    }

    public function show($id)
    {
        return $this->sendResponse($this->salaryService->getById($id), 'Salary retrieved successfully.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        return $this->sendResponse($this->salaryService->create($data), 'Salary created successfully.', 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        return $this->sendResponse($this->salaryService->update($id, $data), 'Salary updated successfully.');
    }

    public function destroy($id)
    {
        $this->salaryService->delete($id);

        return $this->sendResponse([], 'Salary deleted successfully.');
    }
}
