<?php

namespace App\Models;

use App\DB\QueryBuilder;
use ReflectionClass;

abstract class BaseModel
{
    public function save()
    {

        $queryBuilder = new QueryBuilder();
        $tableName    = $this->getTableName();
        $tableColumns = get_object_vars($this);
        return $queryBuilder->insert($tableName, $tableColumns);
    }

    private function getTableName(): string
    {
        $reflect      = new ReflectionClass($this);
        return $reflect->getShortName().'s';
    }

    public static function query(): QueryBuilder
    {
        return new QueryBuilder();
    }
}