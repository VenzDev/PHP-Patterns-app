<?php

/**
 * Adapter pattern for payment methods
 */

namespace App\PaymentMethods\Blik;

use App\Models\Payment;
use App\PaymentMethods\BasePayment;
use App\PaymentMethods\PayInterface;
use App\PaymentMethods\TaxInterface;
use Exception;

class Blik  implements PayInterface, TaxInterface
{

    public const TYPE = 'Blik';

    private array $product;
    private array $payment;
    private float $tax = 0.02;

    public function __construct($data)
    {
    }

    public function calculateTax(string $amount): float
    {
        return (float)$amount * $this->tax + 1.50;
    }

    public function pay(string $productId): bool
    {
        try {
            return true;
        } catch (Exception $e) {
            $this->logToFile($e->getMessage());
        }
    }

    public function logToFile(string $message)
    {
        file_put_contents('./Blik.txt', $message);
    }
}