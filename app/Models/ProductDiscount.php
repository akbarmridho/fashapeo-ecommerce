<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at',
        'valid_until',
    ];

    protected $fillable = [
        'product_id',
        'discount_value',
        'valid_until',
    ];
}
