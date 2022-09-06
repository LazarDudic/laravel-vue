<?php

namespace App\Exceptions;

use Exception;

class ClientErrorException extends Exception
{
    protected $errors;
    protected $exception;
    protected $code;

    public function __construct($message, $httpCode = 400) {
        $this->exception = "ClientErrorException";
        $this->message = $message;
        $this->code = $httpCode;
    }

    public function getErrors()
    {
        return $this->errors;
    }
    public function getException()
    {
        return $this->exception;
    }

    public function render()
    {
        return response()->json([
            'message' => $this->message,
        ], $this->code);
    }
}
