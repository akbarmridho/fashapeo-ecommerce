<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    private $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'destination_province',
        'destination_city',
        'destination_district',
        'destination_delivery',
    ];

    public function customer ()
    {
        return $this->hasOne(Customer::class);
    }

    public function items ()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orderActivities () 
    {
        return $this->hasMany(OrderActivity::class);
    }

    public function orderStatus () 
    {
        return $this->hasOne(Status::class);
    }

    public function transaction ()
    {
        return $this->hasOne(Transaction::class);
    }

    public function shipment ()
    {
        return $this->hasOne(Shipment::class);
    }
}
