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
    public const TYPE = 'CardConnect';

    private array $data;
    private CardConnectService $service;
    private float $tax = 0.16;

    public function __construct(array $data)
    {
        $this->data    = $data;
        $this->service = new CardConnectService();
    }

    public function calculateTax(string $amount): float
    {
        return (float)$amount * $this->tax + 2.00;
    }

    public function pay(string $productId): bool
    {
        try {
            $result = $this->service->capture($this->data);
            if ($result->status != "A") {
                throw new Exception('Invalid Credentials');
            }
            $payment = new Payment();
            $payment->setType($this->data['method']);
            $payment->setTax($this->calculateTax($this->data['amount']));
            $payment->setProductId($productId);
            $payment->save();
        } catch (Exception $e) {
            $this->logToFile($e->getMessage());
        }
    }

    public function logToFile(string $message)
    {
        file_put_contents('./CardConnect.txt', $message);
    }
}

