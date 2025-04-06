<?php

namespace App\Http\Controllers\API\Store\Payment;

use App\Http\Controllers\API\BaseController;
use App\Services\Payment\PaymentService;
use Illuminate\Support\Facades\Request;

class PaymentController extends BaseController
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        $payments = $this->paymentService->getAllPayments();

        return $this->sendResponse($payments, 'Payments retrieved successfully.');
    }

    public function show($id)
    {
        $payment = $this->paymentService->getPaymentById($id);
        if (! $payment) {
            return $this->sendError('Payment not found.');
        }

        return $this->sendResponse($payment, 'Payment retrieved successfully.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|integer',
            'amount' => 'required|numeric',
            'status' => 'required|string',
            // Add other validation rules as needed
        ]);

        $payment = $this->paymentService->createPayment($data);

        return $this->sendResponse($payment, 'Payment created successfully.');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'order_id' => 'required|integer',
            'amount' => 'required|numeric',
            'status' => 'required|string',
            // Add other validation rules as needed
        ]);

        $payment = $this->paymentService->updatePayment($id, $data);
        if (! $payment) {
            return $this->sendError('Payment not found.');
        }

        return $this->sendResponse($payment, 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $deleted = $this->paymentService->deletePayment($id);
        if (! $deleted) {
            return $this->sendError('Payment not found.');
        }

        return $this->sendResponse([], 'Payment deleted successfully.');
    }

    public function getPaymentsByOrderId($orderId)
    {
        $payments = $this->paymentService->getPaymentsByOrderId($orderId);
        if ($payments->isEmpty()) {
            return $this->sendError('No payments found for this order.');
        }

        return $this->sendResponse($payments, 'Payments retrieved successfully.');
    }
}
