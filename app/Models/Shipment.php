<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\DateCast;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin_id',
        'destination_id',
        'courier',
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
        'phone',
    ];

    protected $touches = ['order'];

    protected $casts = [
        'created_at' => DateCast::class,
        'updated_at' => DateCast::class,
    ];

    public function courier()
    {
        return $this->hasOne(Courier::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
