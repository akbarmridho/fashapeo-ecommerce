<?php

namespace App\Actions\Address;

use App\Models\Warehouse;

trait ActiveOriginAddress
{
    public function retreiveActiveOrigin()
    {
        return Warehouse::active()->first()->address;
    }
}
