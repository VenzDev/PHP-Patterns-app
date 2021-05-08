<?php

/**
 * interface that must implement the payment methods (Adapter pattern)
 */
namespace App\PaymentMethods;

interface PayInterface
{
    public function pay(string $productId, string $userId): string;
    public function logToFile(string $message);
}