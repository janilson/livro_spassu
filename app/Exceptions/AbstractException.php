<?php

namespace App\Exceptions;

abstract class AbstractException extends \Exception
{
    public function __construct(string $message = "", int $code = 0)
    {
        parent::__construct($message, $code);
    }

    public function getStatusCode()
    {
        return $this->getCode();
    }
}
