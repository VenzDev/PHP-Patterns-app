<?php

namespace App\Controllers;


use App\Repository\ProductRepository;
use App\Request;
use App\Response;

class ProductController extends AbstractController
{
    private ProductRepository $productRepository;
    public function __construct(Request $request)
    {
        $this->productRepository = new ProductRepository();
        parent::__construct($request);
    }

    public function getProductsAction()
    {
        $userId = $this->request->getParam('userId');
        if($userId) {
            $products = $this->productRepository->getProductByUserId($userId);
            Response::json('success',$products, 'success');
        }

        Response::json('error',null, 'No user Id', 400);
    }
}