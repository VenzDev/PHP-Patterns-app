<?php

/**
 * interface that must implement the payment methods (Adapter pattern)
 */
namespace App\PaymentMethods;

interface TaxInterface
{
    public function calculateTax(string $amount): float;
}