<?php

namespace App\Validator;

/**
 * Validates a POST request.
 */

class Validator
{
    protected $errors = [];
    protected $params = [];

    public function __construct(array $params)
    {
        foreach ($params as $param) {
            if (!array_key_exists($param, $_POST)) {
                if (empty($this->errors['required'])) {
                    $this->errors['required'] = ["{$param}"];
                } else {
                    array_push($this->errors['required'], "{$param}");
                }
                //$this->errors['Required'] = "{$param}";
            } else {
                $this->params[$param] = $_POST[$param];
            }
        }
    }

    public function string(string $string, int $min = 1, int $max = INF): bool|string
    {
        if ($string < $min || $string > $max) {
            return false;
        }
        return $string;
    }

    public function hasErrors()
    {
        if (count($this->errors) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function sendJsonErrors() {
        http_response_code(400);
        echo json_encode($this->getErrors());
        die();
    }
}
