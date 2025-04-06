<?php

namespace App\Repositories;

use App\Interfaces\InventoryRepositoryInterface;
use App\Models\Inventory;

class InventoryRepository implements InventoryRepositoryInterface
{
    public function all()
    {
        return Inventory::with(['product', 'store'])->get();
    }

    public function find($id)
    {
        return Inventory::with(['product', 'store'])->findOrFail($id);
    }

    public function findByProductAndStore($productId, $storeId)
    {
        return Inventory::where('product_id', $productId)
            ->where('store_id', $storeId)
            ->first();
    }

    public function create(array $data)
    {
        return Inventory::create($data);
    }

    public function update($id, array $data)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->update($data);

        return $inventory;
    }

    public function delete($id)
    {
        Inventory::destroy($id);
    }
}
