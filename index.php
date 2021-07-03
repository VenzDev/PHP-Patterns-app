<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");

use App\Controllers\Controller;
use App\Kernel;
use Dotenv\Dotenv;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\PdfController;


require_once realpath("vendor/autoload.php");

//$dotenv = Dotenv::createImmutable(__DIR__);
//$dotenv->load();

$controllersMap = [Controller::class, UserController::class, ProductController::class, PdfController::class];
Kernel::runControllers($controllersMap);


