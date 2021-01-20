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
        return $timestamp->locale(config('app.locale', 'en'))->diffForHumans();
    }

    public static function convertFromUTC(Carbon $timestamp, $format)
    {
        $timestamp->locale(config('app.locale', 'en'));
        return $timestamp->setTimezone(config('app.site-timezone', 'UTC'))->format($format);
    }

    public static function parseToUTC(string $date)
    {
        return Carbon::createFromFormat('Y-m-d H:i', $date, config('app.site-timezone', 'UTC'));
    }
}