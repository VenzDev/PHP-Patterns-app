<?php

namespace App\Controllers;


use App\PaymentMethods\BankTransfer\BankTransfer;
use App\PaymentMethods\Blik\Blik;
use App\PaymentMethods\CardConnect\CardConnect;
use App\Repository\ProductRepository;
use App\Request;
use App\Response;
use JetBrains\PhpStorm\Pure;
use Exception;

class ProductController extends AbstractController
{
    private ProductRepository $productRepository;

    #[Pure] public function __construct(Request $request)
    {
        $this->productRepository = new ProductRepository();
        parent::__construct($request);
    }

    public function getProductsAction()
    {
        $userId = $this->request->getParam('userId');
        if ($userId) {
            $products = $this->productRepository->getProductByUserId($userId);
            Response::json('success', $products, 'success');
        }

        Response::json('error', null, 'No user Id', 400);
    }

    public function buyProductAction()
    {
        try {
            $data      = $this->request->json();
            $productId = $this->productRepository->createProduct($data['product'], $data['userId']);

            if (!$productId) {
                throw new Exception('Product not found');
            }
            $payMethod = $this->getPaymentMethod($data['payment']);
            $result    = $payMethod->pay($productId);

            if (!$result) {
                throw new Exception('Invalid payment credentials.');
            }
            Response::json('success', $productId, 'success');
        } catch (Exception $e) {
            Response::json('error', null, $e->getMessage(), 400);
        }
    }

    private function getPaymentMethod($data)
    {
        $type = $data['method'];
        switch ($type) {
            case BankTransfer::TYPE:
                return new BankTransfer($data);
            case Blik::TYPE:
                return new Blik($data);
            case CardConnect::TYPE:
                return new CardConnect($data);
            default:
                throw new Exception('Payment method not found');
        }
    }
}