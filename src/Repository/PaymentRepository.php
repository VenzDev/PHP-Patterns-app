<?php

namespace App\Repository;

use App\Models\Payment;

class PaymentRepository
{
    public function createPayment($data)
    {

    }

    public function getPaymentById($id)
    {
        return Payment::query()->select('Payments')->where('id',$id)->first();
    }
}