<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    use HasFactory;

    private $fillable = [
        'product_id',
        'discount_percentage',
        'discount_value',
        'valid_until',
    ];
}
