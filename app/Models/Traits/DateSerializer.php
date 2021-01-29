<?php

namespace App\models\Traits;

use App\Transformers\DateConverter;

trait DateSerializer
{
    protected function serializeDate(\DateTimeInterface $date)
    {
        return DateConverter::getConvertedDate(Carbon::instance($date));
    }
}