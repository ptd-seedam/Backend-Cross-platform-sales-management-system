<?php

namespace App\Repositories;

use App\Interfaces\StoreEmployeeRepositoryInterface;
use App\Models\StoreEmployee;

class StoreEmployeeRepository implements StoreEmployeeRepositoryInterface
{
    public function all()
    {
        return StoreEmployee::with(['employee', 'store'])->get();
    }

    public function find($id)
    {
        return StoreEmployee::with(['employee', 'store'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return StoreEmployee::create($data);
    }

    public function update($id, array $data)
    {
        $storeEmployee = StoreEmployee::findOrFail($id);
        $storeEmployee->update($data);

        return $storeEmployee;
    }

    public function delete($id)
    {
        StoreEmployee::destroy($id);
    }
}
