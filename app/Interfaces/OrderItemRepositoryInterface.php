<?php

namespace App\Interfaces;

interface OrderItemRepositoryInterface
{
    public function all($orderId);

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}
