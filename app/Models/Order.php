<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\DateTimeCast;

class Order extends Model
{
    use HasFactory;

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

    protected $casts = [
        'created_at' => DateTimeCast::class,
        'updated_at' => DateTimeCast::class,
        'completed_at' => DateTimeCast::class,
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function status()
    {
        return $this->belongsToMany(Status::class, 'order_activities')->using(OrderActivity::class)->withTimestamps();
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_success', null);
    }

    public function scopeCompleted($query)
    {
        return $query->where('is_success', true);
    }

    public function scopeCancelled($query)
    {
        return $query->where('is_success', false);
    }

    public function scopeWithRelationship($query)
    {
        return $query->with([
            'shipment',
            'transaction',
            'status',
            'items',
        ]);
    }

    public function getWeightAttribute()
    {
        $subtotal = [];

        foreach ($this->items as $item) {
            array_push($subtotal, $item->quantity * $item->product->weight);
        }

        return array_sum($subtotal);
    }

    public function getRecentStatusAttribute()
    {
        return $this->status->sortByDesc('pivot.created_at')->first();
    }

    public function getSubtotalAttribute()
    {
        $final = $this->items->sum('final_price');
        return [
            'int' => $final,
            'sym' => config('payment.currency_symbol') . $final,
        ];
    }
}
