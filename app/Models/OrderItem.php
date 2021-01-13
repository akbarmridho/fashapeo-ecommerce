<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Actions\Calculations\ProductItemTotalPrice as CalculatePrice;

class OrderItem extends Model
{
    use HasFactory, CalculatePrice;

    private $fillable = [
        'order_id',
        'product_id',
        'name',
        'variant',
        'note',
        'quantity',
        'price',
    ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
