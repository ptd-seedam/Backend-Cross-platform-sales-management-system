<?php

namespace App\Http\Controllers\API\Store\ProductImage;

use App\Http\Controllers\API\BaseController;

class ProductImageController extends BaseController
{
    protected $service;

    public function __construct(\App\Services\ProductImage\ProductImageService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->sendResponse($this->service->getAll(), 'Product images retrieved successfully.');
    }

    public function show($id)
    {
        return $this->sendResponse($this->service->getById($id), 'Product image retrieved successfully.');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'image_path' => 'required|string|max:255',
        ]);

        return $this->sendResponse($this->service->create($data), 'Product image created successfully.');
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $data = $request->validate([
            'product_id' => 'sometimes|exists:products,id',
            'image_path' => 'sometimes|string|max:255',
        ]);

        return $this->sendResponse($this->service->update($id, $data), 'Product image updated successfully.');
    }
}
