<?php

namespace App\Models\Traits;

use App\Transformers\DateConverter;

trait DateSerializer
{
    protected function serializeDate(\DateTimeInterface $date)
    {
        return DateConverter::getConvertedDate($date);
    }
}
