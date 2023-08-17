<?php

use App\Core\Response;

$env = parse_ini_file(__DIR__ . '/../../.env', false);

if (empty($env['api_key']) || empty($env['api_base_url'])) {
    return Response::withStatus(500, 'Something went wrong while conecting with the API - COD.1');
}

return $env;
