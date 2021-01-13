<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Actions\Vendor\Rajaongkir;

class CityCode implements Rule
{
    public function passes ($attribute, int $value)
    {
        $rajaongkir = new Rajaongkir();

        if(! $rajaongkir->fetchCities(null, $value)) {
            return false;
        }

        return true;
    }

    public function message ()
    {
        return 'Invalid city code, please contact administrator';
    }
}