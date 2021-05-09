<?php

namespace App\Models;

use App\DB\QueryBuilder;

abstract class BaseModel
{
    protected static QueryBuilder $query;

    public static function loadQueryBuilder()
    {
        self::$query = new QueryBuilder();
    }
}