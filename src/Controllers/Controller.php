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
    public function buyProductAction()
    {
        try {
            (array)$data = json_decode(file_get_contents("php://input"), true);

            $payment           = $this->getPaymentMethod($data);
            $product           = $data['product'];
            $product['userId'] = $data['userId'];


            $productId = Product::create($product);
            $paymentId = $payment->pay($productId, $data['userId']);
            Response::json('success', $paymentId, 'checkout success', 201);
        } catch (Exception $e) {
            Response::json('error', $e->getMessage(), 'Something went wrong', 422);
        }
    }

    public function loginAction()
    {
        $data = Person::login('email', 'password');

        if (empty($data)) {
            Response::json('error', '', 'Wrong Credentials', 422);
        }

        Response::json('success', $data, 'Login success', 200);
    }

    private function getPaymentMethod($data)
    {
        $type = $data['payMethod']['type'];
        switch ($type) {
            case 'BankTransfer':
                return new BankTransfer($data);
            case 'Blik':
                return new Blik($data);
            case 'CardConnect':
                return new CardConnect($data);
        }
    }
}