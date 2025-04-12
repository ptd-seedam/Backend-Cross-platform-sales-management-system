<?php

namespace App\Http\Controllers\Api\Store\Product;

use App\Http\Controllers\Api\BaseController;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return $this->sendResponse($this->productService->getAllProducts(), 'Products retrieved successfully.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        return $this->sendResponse($this->productService->createProduct($data), 'Product created successfully.');
    }

    public function show($id)
    {
        return $this->sendResponse($this->productService->getProduct($id), 'Product retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        return $this->sendResponse($this->productService->updateProduct($id, $request->all()), 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);

        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
