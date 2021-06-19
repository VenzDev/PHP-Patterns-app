<?php

namespace App\Repository;


use App\Models\Product;

class ProductRepository
{
    public function getProductByUserId($id)
    {
        return Product::query()->select('Products')->where('userId',$id)->get();
    }

    public function getProductById($id)
    {
        return Product::query()->select('Products')->where('id',$id)->first();
    }

    public function createProduct($data, $userId)
    {
        $product  = new Product();
        $product->setName($data['name']);
        $product->setWindowAmount($data['windowAmount']);
        $product->setSize($data['size']);
        $product->setMaterial($data['material']);
        $product->setUserId($userId);
        $product->setIsGarage($data['isGarage']);
        $product->setFloors($data['floors']);
        return $product->save();
    }
}