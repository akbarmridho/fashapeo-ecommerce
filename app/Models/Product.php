<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    public function masterProduct()
    {
        return $this->hasOne(MasterProduct::class);
    }

    public function details()
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function image()
    {
        return $this->morphTo(Image::class, 'imageable');
    }

    public function discount()
    {
        return $this->hasOne(ProductDiscount::class);
    }

    public function getProductNameAttribute()
    {
        return $this->masterProduct->name;
    }

    public function getVariantNameAttribute()
    {
        $details = $this->details;
        if($details->isEmpty()) {
            return '';
        }

        $variants = [];

        foreach($details as $detail) {
            array_push($variants, $detail->variant_name);
        }

        return \implode(', ', $variants);
    }

    public function getWeightAttribute()
    {
        return $this->masterProduct->weight;
    }

    public function getActiveDiscountAttribute()
    {
        if(! $this->discount && !$this->discount->valid_until) {
            if($this->discount->valid_until->gt(Carbon::now())) {
                return $this->discount->discount_value;
            }
        } else if(! $this->discount) {
            return $this->discount->discount_value;
        };

        return null;
    }
}
