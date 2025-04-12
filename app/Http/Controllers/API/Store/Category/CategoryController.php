<?php

namespace App\Http\Controllers\Api\Store\Category;

use App\Http\Controllers\API\BaseController;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return $this->sendResponse($this->categoryService->getAll(), 'Categories retrieved successfully.');
    }

    public function show($id)
    {
        return $this->sendResponse($this->categoryService->getById($id), 'Category retrieved successfully.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return $this->sendResponse($this->categoryService->create($data), 'Category created successfully.');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
        ]);

        return $this->sendResponse($this->categoryService->update($id, $data), 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);

        return $this->sendResponse([], 'Category deleted successfully.');
    }
}
