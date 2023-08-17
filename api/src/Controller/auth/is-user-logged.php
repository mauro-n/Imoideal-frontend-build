<?php

use App\Core\Response;

/* echo json_encode(['nome' => 'mauro']);
die(); */

if(!isset($_SESSION['user'])) {
    session_destroy();
    Response::withStatus(401, 'Unauthorized');
};

http_response_code(200);
echo json_encode($_SESSION['user']);
die();