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
        return response()->json($this->service->getAll());
    }

    public function show($id)
    {
        return response()->json($this->service->getById($id));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'image_path' => 'required|string|max:255',
        ]);

        return response()->json($this->service->create($data), 201);
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $data = $request->validate([
            'product_id' => 'sometimes|exists:products,id',
            'image_path' => 'sometimes|string|max:255',
        ]);

        return response()->json($this->service->update($id, $data));
    }
}
