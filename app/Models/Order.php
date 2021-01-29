<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, Traits\DateTimeSerializer;

    protected $dates = [
        'created_at',
        'updated_at',
        'completed_at',
    ];

    protected $fillable = [
        'order_number',
        'user_id',
        'transaction_id',
        'shipment_id',
        'completed_at',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function activities() 
    {
        return $this->hasMany(OrderActivity::class);
    } 

    public function status() 
    {
        return $this->hasManyThrough(Status::class, OrderActivity::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class);
    }

    public function scopeWithRelationship($query)
    {
        return $query->with([
            'shipment',
            'transaction',
            'activities.status',
            'items',
        ]);
    }

    public function scopeRecentStatus($query)
    {
        return $query->status()->latest();
    }

    public function getWeightAttribute()
    {
        $subtotal = [];

        foreach($this->items as $item) {
            array_push($subtotal, $item->quantity * $item->product->weight);
        }

        return array_sum($subtotal);
    }

    public function getRecentStatusAttribute()
    {
        $this->status()->latest()->first();
    }
}
