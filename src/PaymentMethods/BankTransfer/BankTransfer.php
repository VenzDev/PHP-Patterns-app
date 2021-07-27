<?php
/**
 * Adapter pattern for payment methods
 */

namespace App\PaymentMethods\BankTransfer;

use App\Models\Payment;
use App\Models\Product;
use App\PaymentMethods\PayInterface;
use App\PaymentMethods\TaxInterface;
use Exception;

class BankTransfer implements PayInterface, TaxInterface
{
    public const TYPE = 'BankTransfer';

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

    public function transferMoney(): bool
    {
        //TODO fake transfer
        return true;
    }

    public function pay(string $productId): bool
    {
        try {
            $this->transferMoney();

            $payment = new Payment();
            $payment->setType($this->data['method']);
            $payment->setAmount($this->data['amount']);
            $payment->setTax($this->calculateTax($this->data['amount']));
            $payment->setProductId($productId);
            $res = $payment->save();

            if(!$res) {
                throw new Exception('Cannot create payment');
            }
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

    /**
     * @return array[
     *  'controller' => string,
     *  'action' => string
     * ]
     */
    public function returnArray(): array
    {
        return [
                'controller' => 'xd',
                'action' => 'action'
        ];
    }
}