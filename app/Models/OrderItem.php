<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_discount_id',
        'name',
        'variant',
        'note',
        'quantity',
        'price',
        'price_cut',
        'final_price',
    ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getPriceSummaryAttribute()
    {
        return Cache::tags('order_items')->remember('item.' . $this->id, 60 * 5, function () {
            return [
                'price' => config('payment.currency_symbol') . $this->price,
                'price_cut' => $this->price_cut,
                'after_cut' => config('payment.currency_symbol') . ($this->price - $this->price_cut),
                'final_price' => config('payment.currency_symbol') . $this->final_price,
            ];
        });
    }

    public function getImageAttribute()
    {
        return $this->product->master->main_image;
    }
}
