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

    protected $with = [
        'details',
        'image',
        'discount',
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

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function variants()
    {
        return $this->hasManyThrough(Variant::class, ProductDetail::class);
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
            $variants[] = \implode(':', [$detail->variant_name, $detail->variant_id]);
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
        if (!$this->discount && !$this->discount->valid_until) {
            if ($this->discount->valid_until->gt(Carbon::now())) {
                return $this->discount->discount_value;
            }
        } else if (!$this->discount) {
            return $this->discount->discount_value;
        };

        return null;
    }

    public function getSoldAttribute()
    {
        return $this->items()->without(['details', 'image', 'discount'])
            ->with(['order' => function ($query) {
                $query->where('is_success', true);
            }])->count();
    }

    public function getImageFilepondJsonAttribute()
    {
        $image = $this->image;

        if (!$image) {
            return null;
        }

        $pathinfo = \pathinfo($image->url);

        $result = [
            [
                'source' => $image->id,
                'options' => [
                    'type' => 'local',
                    'file' => [
                        'name' => $pathinfo['basename'],
                        'type' => 'image/' . $pathinfo['extension'],
                    ],
                ]
            ]
        ];

        return \json_encode($result);
    }
}
