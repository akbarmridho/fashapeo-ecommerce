<?php

namespace App\Exceptions;

class CannotValidateStatus extends \InvalidArgumentException
{
    public function __construct(
        $message = 'Cannot validate order status',
        $code = 400
        ) {
        parent::__construct($message, $code);
    }
}
