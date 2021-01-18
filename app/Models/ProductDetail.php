<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'variant_id',
        'variant_option_id',
    ];

    public $timestamps = false;

    public function variant()
    {
        return $this->hasOne(Variant::class);
    }

    public function variantOption()
    {
        return $this->hasOne(Variant::class);
    }

    public function getVariantNameAttribute()
    {
        return $this->variant->name . $this->variantOption->name;
    }
}
