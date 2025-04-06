<?php

namespace App\Services\ProductVarient;

use App\Repositories\ProductVarientRepository;

class ProductVarientService
{
    protected $productVarientRepository;

    public function __construct(ProductVarientRepository $productVarientRepository)
    {
        $this->productVarientRepository = $productVarientRepository;
    }

    public function getAllProductVariants()
    {
        return $this->productVarientRepository->all();
    }

    public function getProductVariantById($id)
    {
        return $this->productVarientRepository->find($id);
    }

    public function createProductVariant(array $data)
    {
        return $this->productVarientRepository->create($data);
    }

    public function updateProductVariant($id, array $data)
    {
        return $this->productVarientRepository->update($id, $data);
    }

    public function deleteProductVariant($id)
    {
        return $this->productVarientRepository->delete($id);
    }
}
