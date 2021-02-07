<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\DateCast;

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

    protected $casts = [
        'created_at' => DateCast::class,
        'updated_at' => DateCast::class,
    ];

    public function master()
    {
        return $this->belongsTo(MasterProduct::class, 'master_product_id', 'id');
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

    public function activeDiscount()
    {
        return $this->discount()->active();
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function variants()
    {
        return $this->details()->join('variants', 'product_details.variant_id', '=', 'variants.id');
    }

    public function scopeWithRelationship($query)
    {
        return $query->with(['details', 'image', 'activeDiscount']);
    }

    public function getProductNameAttribute()
    {
        return $this->master->name;
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
        return $this->master->weight;
    }

    public function getSoldAttribute()
    {
        return $this->items()->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.is_success', true)->count();
    }

    public function getImageFilepondJsonAttribute()
    {
        $image = $this->image;

        if (!$image) {
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

    public function getFinalPriceAttribute()
    {
        if ($discount = $this->active_discount) {
            $discountValue = $discount->discount_value;
        } else {
            $discountValue = 0;
        }

        return [
            'has_stock' => $this->stock > 0 ? true : false,
            'initial_price' => config('payment.currency_symbol') . $this->price,
            'discount_value' => $discountValue,
            'final_price' => config('payment.currency_symbol') . ($this->price - $discountValue),
        ];
    }
}
