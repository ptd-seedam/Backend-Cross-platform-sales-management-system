<?php

namespace App\Repositories;

use App\Interfaces\ShipmentRepositoryInterface;
use App\Models\Shipment;

class ShipmentRepository implements ShipmentRepositoryInterface
{
    protected $model;

    public function __construct(Shipment $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $shipment = $this->find($id);
        if ($shipment) {
            $shipment->update($data);

            return $shipment;
        }

        return null;
    }

    public function delete($id)
    {
        $shipment = $this->find($id);
        if ($shipment) {
            $shipment->delete();

            return true;
        }

        return false;
    }

    public function getShipmentsByOrderId($orderId)
    {
        return $this->model->where('order_id', $orderId)->get();
    }
}
