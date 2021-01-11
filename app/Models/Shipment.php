<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    private $fillable = [
        'courier_id',
        'courier_service_code',
        'courier_service',
        'etd',
        'weight',
        'price',
    ];

    public function courier ()
    {
        return $this->hasOne(Courier::class);
    }
}
