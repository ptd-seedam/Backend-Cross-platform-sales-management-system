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
        return $this->sendResponse($this->storeService->getAllStores(), 'Stores retrieved successfully.');
    }

    public function show($id)
    {
        return $this->sendResponse($this->storeService->getStoreById($id), 'Store retrieved successfully.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'manager_id' => 'required|exists:users,id',
        ]);

        return $this->sendResponse($this->storeService->createStore($data), 'Store created successfully.', 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255',
            'manager_id' => 'sometimes|exists:users,id',
        ]);

        return $this->sendResponse($this->storeService->updateStore($id, $data), 'Store updated successfully.');

    }

    public function destroy($id)
    {
        $this->storeService->deleteStore($id);

        return $this->sendResponse([], 'Store deleted successfully.');

    }
}
