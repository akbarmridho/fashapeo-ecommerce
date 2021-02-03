<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use App\Casts\DateCast;

class MasterProduct extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'slug',
        'weight',
        'width',
        'height',
        'length',
    ];

    protected $casts = [
        'created_at' => DateCast::class,
        'updated_at' => DateCast::class,
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function discounts()
    {
        return $this->hasManyThrough(ProductDiscount::class, Product::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function scopeNewArrival($query)
    {
        return $query->orderByDesc('created_at');
    }

    public function scopeWithRelationship($query)
    {
        return $query->with([
            'images',
            'products',
        ]);
    }

    public function getMainImageAttribute()
    {
        return $this->images()->orderByDesc('order')->first();
    }

    public function getSoldAttribute()
    {
        return $this->products()->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.is_success', true)
            ->count();
    }

    public function getMinPriceAttribute()
    {
        return config('payment.currency_symbol') . $this->products()->min('price');
    }

    public function getMaxPriceAttribute()
    {
        return config('payment.currency_symbol') . $this->products()->max('price');
    }

    public function getPriceRangeAttribute()
    {
        $min = $this->products()->min('price');
        $max = $this->products()->max('price');
        $symbol = config('payment.currency_symbol');
        if ($min === $max) {
            return $symbol . $min;
        } else {
            return $symbol . $min . ' -- ' . $symbol . $max;
        }
    }

    public function getPriceAttribute()
    {
        return $this->calculatePrice();
    }

    public function getStockAttribute()
    {
        return $this->products()->sum('stock');
    }

    public function getSingleVariantAttribute()
    {
        return $this->products()->first();
    }

    public function getUsedVariantAttribute()
    {
        $product = $this->single_variant;

        return $product->variant_id;
    }

    public function getImagesFilepondJsonAttribute()
    {
        $images = $this->images()->orderBy('order')->get();

        if ($images->isEmpty()) {
            return null;
        }

        $serialized = $images->toArray();

        $result = [];

        foreach ($serialized as $image) {
            array_push($result, [
                'source' => $image['id'],
                'options' => [
                    'type' => 'local',
                ],
            ]);
        }

        return \json_encode($result);
    }

    protected function calculatePrice()
    {
        $products = $this->products()->get();

        $transformed = $products->map(function ($item, $key) {
            $discount = $item->active_discount ?: 0;

            return [
                'initial_price' => $item->price,
                'discount_value' => $discount,
                'final_price' => $item->price - $discount,
            ];
        });

        $max = $transformed->max('final_price');
        $min = $transformed->mix('final_price');

        $maxModel = $transformed->firstWhere('final_price', $max);
        $minModel = $transformed->firstWhere('final_price', $min);

        return [
            'min_price' => $minModel['initial_price'],
            'max_price' => $maxModel['initial_price'],
            'min_discounted_price' => $minModel['discount_value'],
            'max_discounted_price' => $maxModel['discount_value'],
            'min_final' => $minModel['final_price'],
            'max_final' => $maxModel['final_price'],
        ];
    }

    protected function makeAllSearchableUsing($query)
    {
        return $this->withRelationship();
    }
}
