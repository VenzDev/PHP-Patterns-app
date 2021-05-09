<?php

namespace App\Models;

use App\Response;

class Product extends BaseModel
{
    private const TBL_PRODUCTS = 'Products';
    private const ID = 'id';
    private const NAME = 'name';
    private const TYPE = 'type';

    public static function get($id = null)
    {
        self::loadQueryBuilder();
        if ($id) {
            return self::$query->select(self::TBL_PRODUCTS)->where(self::ID, $id)->get();
        } else {
            return self::$query->select(self::TBL_PRODUCTS)->get();
        }
    }

    public static function create($data)
    {
        self::loadQueryBuilder();

        return self::$query->insert(self::TBL_PRODUCTS, $data)['LAST_INSERT_ID()'];
    }
}