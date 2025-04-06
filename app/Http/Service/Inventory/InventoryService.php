<?php

namespace App\Services\Inventory;

use App\Interfaces\InventoryRepositoryInterface;

class InventoryService
{
    protected $repository;

    public function __construct(InventoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function getById($id)
    {
        return $this->repository->find($id);
    }

    public function getByProductAndStore($productId, $storeId)
    {
        return $this->repository->findByProductAndStore($productId, $storeId);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
