<?php

namespace App\Casts;

use Illuminate\Support\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Transformers\DateConverter as Converter;

class DateDifferenceCast implements CastsAttributes
{
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     *
     * @return Carbon|mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (!isset($value)) {
            return null;
        } else if (is_string($value)) {
            return Converter::getDiffForHuman(Carbon::parse($value));
        }

        return Converter::getDiffForHuman($value);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     *
     * @return array|Carbon|string
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (is_string($value)) {
            return Carbon::parse($value)->setTimezone('UTC');
        }

        return $value->setTimezone('UTC');
    }
}
