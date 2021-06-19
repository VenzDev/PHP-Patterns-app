<?php

namespace App\Controllers;


use App\PaymentMethods\BankTransfer\BankTransfer;
use App\PaymentMethods\Blik\Blik;
use App\PaymentMethods\CardConnect\CardConnect;
use App\Repository\ProductRepository;
use App\Request;
use App\Response;
use JetBrains\PhpStorm\Pure;

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
        $data      = $this->request->json();
        $productId = $this->productRepository->createProduct($data['product'], $data['userId']);

        if (!$productId) {
            Response::json('error', null, 'Invalid credentials', 400);
        }
        $payMethod = $this->getPaymentMethod($data['payment']);
        $result    = $payMethod->pay($productId);

        if (!$result) {
            Response::json('error', null, 'Invalid credentials', 400);
        }
        Response::json('success', null, 'success');
    }

    private function getPaymentMethod($data)
    {
        $type = $data['method'];
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