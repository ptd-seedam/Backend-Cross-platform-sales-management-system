<?php

namespace App\Services\Category;

use App\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getAll()
    {
        return $this->categoryRepo->all();
    }

    public function getById($id)
    {
        return $this->categoryRepo->find($id);
    }

    public function create(array $data)
    {
        return $this->categoryRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->categoryRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->categoryRepo->delete($id);
    }
}
