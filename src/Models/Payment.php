<?php

namespace App\Models;

use App\Response;

class Payment extends BaseModel
{
    private const TBL_PAYMENT = 'Payments';
    private const ID = 'ID';
    private const TYPE = 'type';
    private const TAX = 'tax';
    private const PRODUCT_ID = 'productId';
    private const USER_ID = 'userId';

    public static function get($id = null)
    {
        self::loadQueryBuilder();
        if ($id) {
            return self::$query->select(self::TBL_PAYMENT)->where(self::ID, $id)->get();
        } else {
            return self::$query->select(self::TBL_PAYMENT)->get();
        }
    }

    public static function create($data)
    {
        self::loadQueryBuilder();

        return self::$query->insert(self::TBL_PAYMENT, $data)['LAST_INSERT_ID()'];
    }

}