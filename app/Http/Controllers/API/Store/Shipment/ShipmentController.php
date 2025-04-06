<?php

namespace App\Http\Controllers\API\Store\Shipment;

use App\Http\Controllers\API\BaseController;
use App\Services\Shipment\ShipmentService;
use Illuminate\Support\Facades\Request;

class ShipmentController extends BaseController
{
    protected $shipmentService;

    public function __construct(ShipmentService $shipmentService)
    {
        $this->shipmentService = $shipmentService;
    }

    public function index()
    {
        $shipments = $this->shipmentService->getAllShipments();

        return $this->sendResponse($shipments, 'Shipments retrieved successfully.');
    }

    public function show($id)
    {
        $shipment = $this->shipmentService->getShipmentById($id);
        if (! $shipment) {
            return $this->sendError('Shipment not found.');
        }

        return $this->sendResponse($shipment, 'Shipment retrieved successfully.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|integer',
            'tracking_number' => 'required|string',
            'status' => 'required|string',
            // Add other validation rules as needed
        ]);

        $shipment = $this->shipmentService->createShipment($data);

        return $this->sendResponse($shipment, 'Shipment created successfully.');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'order_id' => 'required|integer',
            'tracking_number' => 'required|string',
            'status' => 'required|string',
            // Add other validation rules as needed
        ]);

        $shipment = $this->shipmentService->updateShipment($id, $data);
        if (! $shipment) {
            return $this->sendError('Shipment not found.');
        }

        return $this->sendResponse($shipment, 'Shipment updated successfully.');
    }

    public function destroy($id)
    {
        $shipment = $this->shipmentService->deleteShipment($id);
        if (! $shipment) {
            return $this->sendError('Shipment not found.');
        }

        return $this->sendResponse([], 'Shipment deleted successfully.');
    }

    public function getShipmentsByOrderId($orderId)
    {
        $shipments = $this->shipmentService->getShipmentsByOrderId($orderId);
        if ($shipments->isEmpty()) {
            return $this->sendError('No shipments found for this order.');
        }

        return $this->sendResponse($shipments, 'Shipments retrieved successfully.');
    }
}
