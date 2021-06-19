<?php

namespace App\Models;

use App\DB\QueryBuilder;
use ReflectionClass;

abstract class BaseModel
{
    public function save()
    {
        $reflect      = new ReflectionClass($this);
        $queryBuilder = new QueryBuilder();
        $tableName    = $reflect->getShortName().'s';
        $tableColumns = get_object_vars($this);
        return $queryBuilder->insert($tableName, $tableColumns);
    }

    public static function query(): QueryBuilder
    {
        return new QueryBuilder();
    }
}