<?php

namespace App\Exceptions;

class CannotValidateProductId extends \InvalidArgumentException
{
    public function __construct(
        $message = 'Cannot validate product id!',
        $code = 400
        ) {
        parent::__construct($message, $code);
    }
}
