<?php

use App\Controllers\Controller;
use App\Kernel;
use Dotenv\Dotenv;

require_once realpath("vendor/autoload.php");

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$person = new \App\Models\Person();

$person->setEmail('email');
$person->setPassword('password');
$person->setFirstName('first');
$person->setLastName('last');
$person->save();

$controllersMap = [Controller::class];
Kernel::runControllers($controllersMap);
