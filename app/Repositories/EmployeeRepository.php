<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function all()
    {
        return Employee::with(['role', 'storeEmployees', 'salaries'])->get();
    }

    public function find($id)
    {
        return Employee::with(['role', 'storeEmployees', 'salaries'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Employee::create($data);
    }

    public function update($id, array $data)
    {
        $employee = Employee::findOrFail($id);
        $employee->update($data);

        return $employee;
    }

    public function delete($id)
    {
        Employee::destroy($id);
    }
}
