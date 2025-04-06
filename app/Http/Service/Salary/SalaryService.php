<?php

namespace App\Services\Salary;

use App\Interfaces\SalaryRepositoryInterface;

class SalaryService
{
    protected $salaryRepo;

    public function __construct(SalaryRepositoryInterface $salaryRepo)
    {
        $this->salaryRepo = $salaryRepo;
    }

    public function getAll()
    {
        return $this->salaryRepo->all();
    }

    public function getById($id)
    {
        return $this->salaryRepo->find($id);
    }

    public function create(array $data)
    {
        return $this->salaryRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->salaryRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->salaryRepo->delete($id);
    }
}
