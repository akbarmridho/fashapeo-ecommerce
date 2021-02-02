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
        $timestamp->setTimezone(config('app.site-timezone', 'UTC'));

        return $timestamp->diffForHumans();
    }

    public static function convertFromUTC(Carbon $timestamp, $format)
    {
        return $timestamp->setTimezone(config('app.site-timezone', 'UTC'))->format($format);
    }

    public static function parseToUTC(string $date)
    {
        if (! $date) {
            return null;
        }

        return Carbon::createFromFormat('Y-m-d H:i', $date, config('app.site-timezone', 'UTC'));
    }

    public static function setLocale(Carbon $timestamp)
    {
        return $timestamp->locale(config('app.locale'));
    }
}
