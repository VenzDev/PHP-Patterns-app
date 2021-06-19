<?php

/**
 * interface that must implement the payment methods (Adapter pattern)
 */
namespace App\PaymentMethods;

interface PayInterface
{
    public function pay(string $productId): bool;
    public function logToFile(string $message);
}