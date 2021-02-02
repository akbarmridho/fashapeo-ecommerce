<?php

namespace App\Transformers;

use Illuminate\Support\Carbon;

class DateConverter
{
    public static function getConvertedDate(Carbon $timestamp)
    {
        return self::convertFromUTC($timestamp, 'j F Y');
    }

    public static function getConvertedDateTime(Carbon $timestamp)
    {
        return self::convertFromUTC($timestamp, 'j F Y, H:i');
    }

    public static function getDiffForHuman(Carbon $timestamp)
    {
        (self::setLocale($timestamp))->setTimezone(config('app.site-timezone', 'UTC'));

        return $timestamp->diffForHumans();
    }

    public static function convertFromUTC(Carbon $timestamp, $format)
    {
        return (self::setLocale($timestamp))->setTimezone(config('app.site-timezone', 'UTC'))->format($format);
    }

    public static function parseToUTC(string $date)
    {
        if (!$date) {
            return null;
        }

        return self::setLocale(Carbon::createFromFormat('Y-m-d H:i', $date, config('app.site-timezone', 'UTC')));
    }

    public static function setLocale(Carbon $timestamp)
    {
        if (config('app.locale') !== 'en') {
            return $timestamp->locale(config('app.locale'));
        }

        return $timestamp;
    }
}
