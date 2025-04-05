<?php

namespace App\Http\Controllers\Api\Store;

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
        return response()->json($this->productService->getAllProducts());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        return response()->json($this->productService->createProduct($data), 201);
    }

    public function show($id)
    {
        return response()->json($this->productService->getProduct($id));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->productService->updateProduct($id, $request->all()));
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);

        return response()->json(['message' => 'Deleted']);
    }
}
