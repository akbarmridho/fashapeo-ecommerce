<?php

namespace App\Transformers;

class RajaongkirTransformer
{
    public static function transformProvinces(array $array)
    {
        return collect($array)->map(function ($item, $key) {
            return [
                'id' => $item['province_id'],
                'name' => $item['province'],
            ];
        })->sortBy('name');
    }

    public static function transformCities(array $array)
    {
        return collect($array)->map(function ($item, $key) {
            return [
                'name' => $item['type'].' '.$item['city_name'],
                'id' => $item['city_id'],
                'province_id' => $item['province_id'],
            ];
        })->sortBy('name');
    }

    public static function transformCost(array $array)
    {
        return collect($array);
    }
}
