<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'courier_id',
        'origin_id',
        'destination_id',
        'service',
        'etd',
        'price',
        'weight',
        'tracking_number',
        'destination_province',
        'destination_city',
        'destination_district',
        'destination_delivery',
        'destination_name',
        'postal_code',
        'phone'
    ];

    protected $touches = ['order'];

    public function courier()
    {
        return $this->hasOne(Courier::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
