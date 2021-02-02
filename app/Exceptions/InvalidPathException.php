<?php

namespace App\Exceptions;

class InvalidPathException extends \InvalidArgumentException
{
    public function __construct(
        $message = 'The given file path is invalid',
        $code = 400
        ) {
        parent::__construct($message, $code);
    }
}
