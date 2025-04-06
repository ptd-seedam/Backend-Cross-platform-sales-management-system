<?php

namespace App\Services\Employee;

use App\Interfaces\EmployeeRepositoryInterface;

class EmployeeService
{
    protected $employeeRepo;

    public function __construct(EmployeeRepositoryInterface $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    }

    public function getAll()
    {
        return $this->employeeRepo->all();
    }

    public function getById($id)
    {
        return $this->employeeRepo->find($id);
    }

    public function create(array $data)
    {
        return $this->employeeRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->employeeRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->employeeRepo->delete($id);
    }
}
