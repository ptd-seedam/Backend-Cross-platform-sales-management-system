<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return response()->json($this->userService->getAllUsers());
    }

    public function show($id)
    {
        return response()->json($this->userService->getUser($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        return response()->json($this->userService->createUser($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'nullable|string|min:8',
        ]);

        return response()->json($this->userService->updateUser($id, $data));
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return response()->json(['message' => 'User deleted']);
    }
}
