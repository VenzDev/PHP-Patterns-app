<?php

namespace App\Repository;


use App\Models\Product;

class ProductRepository
{
    public function getProductByUserId($id)
    {
        return Product::query()->select('Products')->where('userId',$id)->get();
    }
}