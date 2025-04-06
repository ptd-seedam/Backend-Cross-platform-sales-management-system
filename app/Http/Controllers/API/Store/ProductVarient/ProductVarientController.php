<?php

namespace App\Http\Controllers\API\Store\ProductVarient;

use App\Http\Controllers\API\BaseController;
use App\Services\ProductVarient\ProductVarientService;
use Illuminate\Http\Request;

class ProductVarientController extends BaseController
{
    protected $productVarientService;

    public function __construct(ProductVarientService $productVarientService)
    {
        $this->productVarientService = $productVarientService;
    }

    public function index()
    {
        $productVariants = $this->productVarientService->getAllProductVariants();

        return $this->sendResponse($productVariants, 'Product variants retrieved successfully.');
    }

    public function show($id)
    {
        $productVariant = $this->productVarientService->getProductVariantById($id);

        return $this->sendResponse($productVariant, 'Product variant retrieved successfully.');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_name' => 'required|string|max:255',
            'variant_value' => 'required|string|max:255',
        ]);

        $productVariant = $this->productVarientService->createProductVariant($validatedData);

        return $this->sendResponse($productVariant, 'Product variant created successfully.', 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_id' => 'sometimes|required|exists:products,id',
            'variant_name' => 'sometimes|required|string|max:255',
            'variant_value' => 'sometimes|required|string|max:255',
        ]);

        $productVariant = $this->productVarientService->updateProductVariant($id, $validatedData);

        return $this->sendResponse($productVariant, 'Product variant updated successfully.');
    }

    public function destroy($id)
    {
        $this->productVarientService->deleteProductVariant($id);

        return $this->sendResponse([], 'Product variant deleted successfully.');
    }
}
