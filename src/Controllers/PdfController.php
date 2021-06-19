<?php

namespace App\Controllers;

use App\PDF\PdfFacade;
use App\Repository\PaymentRepository;
use App\Repository\ProductRepository;
use App\Request;
use App\Response;

class PdfController extends AbstractController
{
    private ProductRepository $productRepository;
    private PaymentRepository $paymentRepository;

    public function __construct(Request $request)
    {
        $this->productRepository = new ProductRepository();
        $this->paymentRepository = new PaymentRepository();
        parent::__construct($request);
    }

    public function downloadPdfAction()
    {
        $productId = $this->request->getParam('productId');
        if(!$productId) {
            Response::json('error',null,'invalid product id',400);
        }

        $product = $this->productRepository->getProductById($productId);
        if(!$product) {
            Response::json('error',null,'Product not found',400);
        }

        $payment = $this->paymentRepository->getPaymentById($product['paymentId']);
        if(!$payment) {
            Response::json('error',null,'Payment not found',400);
        }

        $pdf = new PdfFacade();
        $pdf->downloadPdf($product, $payment);

    }
}