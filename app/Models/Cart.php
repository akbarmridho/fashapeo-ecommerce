<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function customer () {
        return $this->hasOne(Customer::class);
    }

    public function product () {
        return $this->hasOne(Product::class);
    }
}
