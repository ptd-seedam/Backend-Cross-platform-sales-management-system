<?php

namespace App\Http\Controllers\Api;

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
        return response()->json($this->salaryService->getAll());
    }

    public function show($id)
    {
        return response()->json($this->salaryService->getById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        return response()->json($this->salaryService->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        return response()->json($this->salaryService->update($id, $data));
    }

    public function destroy($id)
    {
        $this->salaryService->delete($id);

        return response()->json(['message' => 'Salary record deleted']);
    }
}
