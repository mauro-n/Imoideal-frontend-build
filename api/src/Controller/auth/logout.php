<?php

use App\Core\Response;

if ($_SESSION['user']) {
    session_destroy();
    Response::withStatus(200, 'ok');
}

Response::withStatus(401, "Unauthorized");