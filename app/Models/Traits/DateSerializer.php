<?php

namespace App\Models\Traits;

use Illuminate\Support\Carbon;
use App\Transformers\DateConverter;

trait DateSerializer
{
    protected function serializeDate(\DateTimeInterface $date)
    {
        return DateConverter::getConvertedDate(Carbon::instance($date));
    }
}
