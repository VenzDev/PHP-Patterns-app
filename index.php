<?php

use App\Controllers\Controller;
use App\Kernel;
use Dotenv\Dotenv;

require_once realpath("vendor/autoload.php");

//$dotenv = Dotenv::createImmutable(__DIR__);
//$dotenv->load();

$controllersMap = [Controller::class];
Kernel::runControllers($controllersMap);
