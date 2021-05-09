<?php

namespace App\Models;

use App\Response;

class Person extends BaseModel
{
    private const TBL_PERSONS = 'Persons';
    private const ID = 'ID';
    private const FIRST_NAME = 'firstName';
    private const LAST_NAME = 'lastName';
    private const EMAIL = 'email';
    private const PASSWORD = 'password';

    public static function get($id = null)
    {
        self::loadQueryBuilder();
        if ($id) {
            return self::$query->select(self::TBL_PERSONS)->where(self::ID, $id)->get();
        } else {
            return self::$query->select(self::TBL_PERSONS)->get();
        }
    }

    public static function create($data)
    {
        self::loadQueryBuilder();

        return self::$query->insert(self::TBL_PRODUCTS, $data)['LAST_INSERT_ID()'];
    }

    public static function login($email, $password)
    {
        self::loadQueryBuilder();

        return self::$query
            ->select(self::TBL_PERSONS)
            ->where(self::EMAIL, $email)
            ->where(self::PASSWORD, $password)
            ->get();
    }
}