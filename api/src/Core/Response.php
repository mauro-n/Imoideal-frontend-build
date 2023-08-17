<?php

namespace App\Core;

class Response
{
    public static function withStatus(int $status, string $msg = null)
    {
        http_response_code($status);
        if (empty($msg)) die();
        echo (Response::parseMsg($msg));
        die();
    }

    private static function parseMsg($msg)
    {
        return json_encode(['message' => $msg]);
    }
}
