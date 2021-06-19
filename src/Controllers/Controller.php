<?php

namespace App\Controllers;

use App\Models\Person;
use App\Models\Product;
use App\PaymentMethods\BankTransfer\BankTransfer;
use App\PaymentMethods\Blik\Blik;
use App\PaymentMethods\CardConnect\CardConnect;
use App\Response;
use Exception;

class Controller extends AbstractController
{
    public function helloAction()
    {
        Response::json('success', '', 'success', 201);
    }

}