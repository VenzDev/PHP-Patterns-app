<?php

use App\DB\QueryBuilder;
use Dotenv\Dotenv;

require_once realpath("vendor/autoload.php");

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$queryBuilder = new QueryBuilder();

try {
    $result = $queryBuilder
        ->select('Persons', ['Persons.firstName', 'Orders.ID'])
        ->where('Persons.firstName', 'ADRIAN')
        ->join('Orders', 'Orders.PersonID', 'Persons.ID')
        ->get();

    var_dump($result);
} catch (Exception $e) {
    var_dump($e->getMessage());
}


