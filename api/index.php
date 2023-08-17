<?php
/* Bootstraps the app */
require './bootstrap/app.php';
require './src/Helper/controller.php';

$router->post('/api/create-login', controller('auth/create-login.php'));
$router->get('/api/auth-user', controller('auth/is-user-logged.php'));
$router->get('/api/content', controller('content.php'));
$router->post('/api/login', controller('auth/login.php'));
$router->route();

die();
