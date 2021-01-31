<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Actions\Calculations\ProductItemTotalPrice as CalculatePrice;

class OrderItem extends Model
{
    use HasFactory, CalculatePrice;

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
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
