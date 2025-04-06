<?php

namespace App\Repositories;

use App\Interfaces\PaymentRepositoryInterface;
use App\Models\Payment;

class PaymentRepository implements PaymentRepositoryInterface
{
    protected $model;

    public function __construct(Payment $model)
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
        $payment = $this->find($id);
        if ($payment) {
            $payment->update($data);

            return $payment;
        }

        return null;
    }

    public function delete($id)
    {
        $payment = $this->find($id);
        if ($payment) {
            $payment->delete();

            return true;
        }

        return false;
    }

    public function getPaymentsByOrderId($orderId)
    {
        return $this->model->where('order_id', $orderId)->get();
    }
}
