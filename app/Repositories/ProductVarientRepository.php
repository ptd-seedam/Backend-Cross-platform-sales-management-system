<?php

namespace App\Repositories;

use App\Interfaces\ProductVarientRepositoryInterface;
use App\Models\ProductVariant;

class ProductVarientRepository implements ProductVarientRepositoryInterface
{
    public function all()
    {
        return ProductVariant::with('product')->get();
    }

    public function find($id)
    {
        return ProductVariant::with('product')->findOrFail($id);
    }

    public function create(array $data)
    {
        return ProductVariant::create($data);
    }

    public function update($id, array $data)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->update($data);

        return $productVariant;
    }

    public function delete($id)
    {
        return ProductVariant::destroy($id);
    }
}
