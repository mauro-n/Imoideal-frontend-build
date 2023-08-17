<?php

use App\Core\Response;
use App\Validator\Validator;

$env = require __DIR__ . '/../../Config/env.php';
define('createLoginUrl', 'create-login');

/* Validation */
$validator = new Validator([
    'email', 'name', 'phone', 'pwd'
]);

if ($validator->hasErrors()) {
    $validator->sendJsonErrors();
}

$data = [];
$data['email'] = $_POST['email'];
$data['nome'] = $_POST['name'];
$data['telefone'] = $_POST['phone'];
$data['pass'] = $_POST['pwd'];

try {
    $ch = curl_init();
    /* setting the options */
    curl_setopt($ch, CURLOPT_URL, $env['api_base_url'] . createLoginUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    /* setting headers */
    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = "Api-Key: {$env['api_key']}";
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo (json_encode(['Error' => curl_error($ch)]));
    }

    curl_close($ch);
    $result = json_decode($result, true);

    if (empty($result['error_message'])) {
        http_response_code(200);
        echo json_encode($result);
        $_SESSION['user'] = $result;
        die();
    }
    Response::withStatus(400, $result['error_message']);
    die();
} catch (Exception $err) {
    Response::withStatus(500, 'Erro no curl');
    die();
}
