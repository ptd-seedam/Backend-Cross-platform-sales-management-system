<?php

namespace App\Http\Service\Store;

use App\Repositories\StoreRepository;

class StoreService
{
    protected $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function getAllStores()
    {
        return $this->storeRepository->all();
    }

    public function getStoreById($id)
    {
        return $this->storeRepository->find($id);
    }

    public function createStore(array $data)
    {
        return $this->storeRepository->create($data);
    }

    public function updateStore($id, array $data)
    {
        return $this->storeRepository->update($id, $data);
    }

    public function deleteStore($id)
    {
        return $this->storeRepository->delete($id);
    }
}
