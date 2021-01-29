<?php

namespace App\models\Traits;

use Illuminate\Support\Carbon;
use App\Transformers\DateConverter;

trait DateTimeSerializer
{
    protected function serializeDate(\DateTimeInterface $date)
    {
        return DateConverter::getConvertedDateTime(Carbon::instance($date));
    }
}