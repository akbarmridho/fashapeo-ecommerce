<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    private $fillable = [
        'courier_id',
        'origin_id',
        'destination_id',
        'service',
        'etd',
        'price',
        'weight',
        'tracking_number',
    ];

    public function courier ()
    {
        return $this->hasOne(Courier::class);
    }
}
