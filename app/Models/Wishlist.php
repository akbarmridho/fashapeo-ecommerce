<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'master_product_id'
    ];

    protected $with = ['product'];

    public function customer() {
        return $this->hasOne(Customer::class);
    }

    public function product() {
        return $this->hasOne(MasterProduct::class);
    }
}
