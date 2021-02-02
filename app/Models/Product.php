<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Product extends Model
{
    use HasFactory, Traits\DateSerializer;

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
        return $this->morphOne(Image::class, 'imageable');
    }

    public function discount()
    {
        return $this->hasOne(ProductDiscount::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function variants()
    {
        return $this->details()->join('variants', 'product_details.variant_id', '=', 'variants.id');
    }

    public function withRelationship()
    {
        return $this->with(['details', 'images', 'discount']);
    }

    public function getProductNameAttribute()
    {
        return $this->masterProduct->name;
    }

    public function getVariantNameAttribute()
    {
        $details = $this->details;

        if ($details->isEmpty()) {
            return null;
        }

        $variants = [];

        foreach ($details as $detail) {
            array_push($variants, $detail->variant_name);
        }

        return \implode(', ', $variants);
    }

    public function getVariantIdAttribute()
    {
        $details = $this->details;

        if ($details->isEmpty()) {
            return null;
        }

        $variants = [];

        foreach ($details as $detail) {
            $variants[] = \implode(':', [$detail->variant_type, $detail->variant_id]);
        }

        return \implode(',', $variants);
    }

    public function getVariantCountAttribute()
    {
        return $this->details()->count();
    }

    public function getWeightAttribute()
    {
        return $this->masterProduct->weight;
    }

    public function getActiveDiscountAttribute()
    {
        if (! $this->discount && ! $this->discount->valid_until) {
            if ($this->discount->valid_until->gt(Carbon::now())) {
                return $this->discount->discount_value;
            }
        } elseif (! $this->discount) {
            return $this->discount->discount_value;
        }

        return null;
    }

    public function getSoldAttribute()
    {
        return $this->items()->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.is_success', true)->count();
    }

    public function getImageFilepondJsonAttribute()
    {
        $image = $this->image;

        if (! $image) {
            return null;
        }

        $result = [
            [
                'source' => $image->id,
                'options' => [
                    'type' => 'local',
                ],
            ],
        ];

        return \json_encode($result);
    }
}
