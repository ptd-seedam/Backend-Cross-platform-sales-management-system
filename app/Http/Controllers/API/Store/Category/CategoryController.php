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
        return response()->json($this->categoryService->getAll());
    }

    public function show($id)
    {
        return response()->json($this->categoryService->getById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return response()->json($this->categoryService->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
        ]);

        return response()->json($this->categoryService->update($id, $data));
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);

        return response()->json(['message' => 'Category deleted']);
    }
}
