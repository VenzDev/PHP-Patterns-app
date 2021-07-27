<?php

namespace App\Controllers;

use App\PDF\PdfFacade;
use App\Repository\PaymentRepository;
use App\Repository\ProductRepository;
use App\Request;
use App\Response;
use Exception;

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
        $pdf = new PdfFacade();

        try {
            $productId = $this->request->getParam('productId');
            if(!$productId) {
                throw new Exception('Invalid product Id');
            }

            $product = $this->productRepository->getProductById($productId);
            if(!$product) {
                throw new Exception('Product not found');
            }

            $payment = $this->paymentRepository->getPaymentByProductId($productId);
            if(!$payment) {
                throw new Exception('Payment not found');
            }

            $pdf->downloadPdf($product, $payment);
        }catch(Exception $e) {
            Response::json('error',null,$e->getMessage(),400);
        }
    }
}