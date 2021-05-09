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
    private array $product;
    private array $payment;
    private float $tax = 0.18;

    public function __construct($data)
    {
        $this->product = $data['product'];
        $this->payment = $data['payMethod'];
    }

    public function calculateTax(string $amount): float
    {
        return (float)$amount * $this->tax;
    }

    public function pay(string $productId, string $userId): string
    {
        try {
            $subtotal = $this->product['amount'] * $this->product['pricePerOne'];
            $tax      = $this->calculateTax($subtotal);


            Payment::create(
                [
                    'tax'       => $tax,
                    'total'     => $subtotal + $tax,
                    'type'      => 'BankTransfer',
                    'productId' => $productId,
                    'userId'    => $userId
                ],
            );

            return 'success';
        } catch (Exception $e) {
            $this->logToFile($e->getMessage());
        }
    }

    public function logToFile(string $message)
    {
        file_put_contents('./BankTransfer.txt', $message);
    }
}