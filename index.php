<?php

session_start();
require_once __DIR__."./vendor/autoload.php";
require_once "./Config/config.php";

$dotenv= Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
use Views\Layout\header;
use Controllers\FrontController;
FrontController::main();


?>
