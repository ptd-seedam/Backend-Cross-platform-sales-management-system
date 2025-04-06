<?php

namespace App\Http\Controllers\API\Store\Store;

use App\Http\Controllers\API\BaseController;
use App\Http\Service\Store\StoreService;
use Illuminate\Support\Facades\Request;

class StoreController extends BaseController
{
    protected $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function index()
    {
        return response()->json($this->storeService->getAllStores());
    }

    public function show($id)
    {
        return response()->json($this->storeService->getStoreById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'manager_id' => 'required|exists:users,id',
        ]);

        return response()->json($this->storeService->createStore($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255',
            'manager_id' => 'sometimes|exists:users,id',
        ]);

        return response()->json($this->storeService->updateStore($id, $data));
    }

    public function destroy($id)
    {
        $this->storeService->deleteStore($id);

        return response()->json(['message' => 'Store deleted']);
    }
}
