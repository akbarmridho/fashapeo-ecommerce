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

    protected $with = [
        'variant',
        'variantOption',
    ];

    public $timestamps = false;

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function variantOption()
    {
        return $this->belongsTo(VariantOption::class);
    }

    public function getVariantNameAttribute()
    {
        return $this->variant->name . ' ' . $this->variantOption->name;
    }

    public function getVariantTypeAttribute()
    {
        return $this->variant->name;
    }
}
