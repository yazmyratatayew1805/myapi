<?php

require '../vendor/autoload.php';

use App\Controller\UserController;

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$path = explode('/', trim($_SERVER['PATH_INFO'], '/'));

$controller = new UserController();
$controller->processRequest($method, $path);
