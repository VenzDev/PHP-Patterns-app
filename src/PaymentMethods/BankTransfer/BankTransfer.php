<?php
/**
 * Adapter pattern for payment methods
 */

namespace App\PaymentMethods\BankTransfer;

use App\PaymentMethods\BasePayment;
use App\PaymentMethods\PayInterface;

class BankTransfer extends BasePayment implements PayInterface
{
    public function pay(string $productId, string $userId): string
    {
        // TODO: Implement pay() method.
    }

    public function logToFile(string $message)
    {
        // TODO: Implement logToFile() method.
    }
}