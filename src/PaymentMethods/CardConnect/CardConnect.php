<?php

/**
 * Adapter pattern for payment methods
 */

namespace App\PaymentMethods\CardConnect;

use App\Models\Payment;
use App\PaymentMethods\BasePayment;
use App\PaymentMethods\PayInterface;
use App\PaymentMethods\TaxInterface;
use Exception;

class CardConnect implements PayInterface, TaxInterface
{
    private array $data;
    private float $tax = 0.16;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function calculateTax(string $amount): float
    {
        return (float)$amount * $this->tax + 2.00;
    }

    public function pay(string $productId): bool
    {
        try {
            //TODO fake
            $accountId = $this->data['account'];


            $payment = new Payment();
            $payment->setType($this->data['method']);

        } catch (Exception $e) {
            $this->logToFile($e->getMessage());
        }
    }

    public function logToFile(string $message)
    {
        file_put_contents('./CardConnect.txt', $message);
    }
}

