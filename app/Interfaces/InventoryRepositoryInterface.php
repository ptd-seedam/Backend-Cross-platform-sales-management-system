<?php

namespace App\Interfaces;

interface InventoryRepositoryInterface
{
    public function all();

    public function find($id);

    public function findByProductAndStore($productId, $storeId);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}
