<?php

namespace App\Services\User;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAllUsers()
    {
        return $this->userRepo->all();
    }

    public function getUser($id)
    {
        return $this->userRepo->find($id);
    }

    public function createUser(array $data)
    {
        // Hash password trước khi lưu
        $data['password'] = Hash::make($data['password']);

        return $this->userRepo->create($data);
    }

    public function updateUser($id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']); // Hash password nếu có thay đổi
        }

        return $this->userRepo->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepo->delete($id);
    }
}
