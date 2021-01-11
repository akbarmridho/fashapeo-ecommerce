<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'master_product_id',
        'stock',
        'price',
        'sku',
        'active',
    ];

    public function masterProduct () {
        return $this->hasOne(MasterProduct::class);
    }

    public function details () {
        return $this->hasMany(ProductDetail::class);
    }

    public function image () {
        return $this->morphTo(Image::class, 'imageable');
    }

    public function discount () {
        return $this->hasMany(ProductDiscount::class);
    }
}
