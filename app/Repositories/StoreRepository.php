<?php

namespace App\Repositories;

use App\Interfaces\StoreRepositoryInterface;
use App\Models\Store;

class StoreRepository implements StoreRepositoryInterface
{
    public function all()
    {
        return Store::with(['storeEmployees', 'inventories'])->get();
    }

    public function find($id)
    {
        return Store::with(['storeEmployees', 'inventories'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Store::create($data);
    }

    public function update($id, array $data)
    {
        $store = Store::findOrFail($id);
        $store->update($data);

        return $store;
    }

    public function delete($id)
    {
        Store::destroy($id);
    }
}
