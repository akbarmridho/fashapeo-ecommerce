<?php

namespace App\Models\Traits;

use App\Transformers\DateConverter;

trait DateTimeSerializer
{
    protected function serializeDate(\DateTimeInterface $date)
    {
        return DateConverter::getConvertedDateTime($date);
    }
}
