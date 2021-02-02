<?php

namespace App\Exceptions;

class CannotValidateOrder extends \InvalidArgumentException
{
    public function __construct(
        $message = 'Check your route middleware parameter',
        $code = 400
    ) {
        parent::__construct($message, $code);
    }
}
