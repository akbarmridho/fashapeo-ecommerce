<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    private $fillable = [
        'user_id',
        'master_product_id'
    ];

    public function customer () {
        return $this->hasOne(Customer::class);
    }

    public function products () {
        return $this->hasMany(MasterProduct::class);
    }
}
