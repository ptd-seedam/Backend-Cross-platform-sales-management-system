<?php

namespace App\Repositories;

use App\Models\ProductImage;

class ProductImageRepository implements \App\Interfaces\ProductImageRepositoryInterface
{
    public function all()
    {
        return ProductImage::with('product')->get();
    }

    public function find($id)
    {
        return ProductImage::with('product')->findOrFail($id);
    }

    public function create(array $data)
    {
        return ProductImage::create($data);
    }

    public function update($id, array $data)
    {
        $productImage = \App\Models\ProductImage::findOrFail($id);
        $productImage->update($data);

        return $productImage;
    }

    public function delete($id)
    {
        return ProductImage::destroy($id);
    }
}
