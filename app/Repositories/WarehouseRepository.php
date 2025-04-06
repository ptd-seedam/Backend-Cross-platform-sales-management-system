<?php

namespace App\Repositories;

use App\Interfaces\WarehouseRepositoryInterface;
use App\Models\Warehouse;

class WarehouseRepository implements WarehouseRepositoryInterface
{
    public function all()
    {
        return Warehouse::with('store')->get();
    }

    public function find($id)
    {
        return Warehouse::with('store')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Warehouse::create($data);
    }

    public function update($id, array $data)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->update($data);

        return $warehouse;
    }

    public function delete($id)
    {
        return Warehouse::destroy($id);
    }
}
