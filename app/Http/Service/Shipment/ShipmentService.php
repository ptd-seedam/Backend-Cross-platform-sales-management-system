<?php

namespace App\Services\Shipment;

use App\Repositories\ShipmentRepository;

class ShipmentService
{
    protected $shipmentRepository;

    public function __construct(ShipmentRepository $shipmentRepository)
    {
        $this->shipmentRepository = $shipmentRepository;
    }

    public function getAllShipments()
    {
        return $this->shipmentRepository->all();
    }

    public function getShipmentById($id)
    {
        return $this->shipmentRepository->find($id);
    }

    public function createShipment(array $data)
    {
        return $this->shipmentRepository->create($data);
    }

    public function updateShipment($id, array $data)
    {
        return $this->shipmentRepository->update($id, $data);
    }

    public function deleteShipment($id)
    {
        return $this->shipmentRepository->delete($id);
    }

    public function getShipmentsByOrderId($orderId)
    {
        return $this->shipmentRepository->getShipmentsByOrderId($orderId);
    }
}
