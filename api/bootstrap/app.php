<?php

/* Bootstraps configurations */
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Config/Cors.php';

use App\Router\Router;

session_start();
$router = new Router();
