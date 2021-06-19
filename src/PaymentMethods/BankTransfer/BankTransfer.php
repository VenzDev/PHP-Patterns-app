<?php
/**
 * Adapter pattern for payment methods
 */

namespace App\PaymentMethods\BankTransfer;

use App\Models\Payment;
use App\PaymentMethods\PayInterface;
use App\PaymentMethods\TaxInterface;
use Exception;

class BankTransfer implements PayInterface, TaxInterface
{
    private array $data;
    private float $tax = 0.16;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
    public function calculateTax(string $amount): float
    {
        return (float)$amount * $this->tax;
    }

    public function pay(string $productId): bool
    {
        try {
            //TODO fake payment by bankTransfer
            $accountId = $this->data['accountId'];

            $payment = new Payment();
            $payment->setType($this->data['method']);
            $payment->setTax($this->calculateTax($this->data['amount']));
            $payment->setProductId($productId);
            $payment->save();

            return true;
        } catch (Exception $e) {
            $this->logToFile($e->getMessage());
            return false;
        }
    }

    public function logToFile(string $message)
    {
        file_put_contents('./logs/BankTransfer.txt', $message);
    }
}