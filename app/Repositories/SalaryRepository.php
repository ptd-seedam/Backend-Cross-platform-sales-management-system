<?php

namespace App\Repositories;

use App\Interfaces\SalaryRepositoryInterface;
use App\Models\Salary;

class SalaryRepository implements SalaryRepositoryInterface
{
    public function all()
    {
        return Salary::with('employee')->get();
    }

    public function find($id)
    {
        return Salary::with('employee')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Salary::create($data);
    }

    public function update($id, array $data)
    {
        $salary = Salary::findOrFail($id);
        $salary->update($data);

        return $salary;
    }

    public function delete($id)
    {
        Salary::destroy($id);
    }
}
