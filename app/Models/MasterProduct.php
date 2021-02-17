<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use App\Casts\DateCast;
use Illuminate\Support\Facades\Cache;

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
        return $query->latest();
    }

    public function scopeWithRelationship($query)
    {
        return $query->with([
            'images',
            'products.activeDiscount',
            'products.details'
        ]);
    }

    public function getMainImageAttribute()
    {
        return $this->images->sortByDesc('order')->first();
    }

    public function getSoldAttribute()
    {
        return Cache::tags(['products'])->remember('product.' . $this->id . '.sold', 60 * 60, function () {
            return $this->products()->join('order_items', 'products.id', '=', 'order_items.product_id')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('orders.is_success', true)
                ->count();
        });
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
            return $symbol . $min . ' — ' . $symbol . $max;
        }
    }

    public function getPriceAttribute()
    {
        return $this->calculatePrice();
    }

    public function getStockAttribute()
    {
        return $this->products->sum('stock');
    }

    public function getSingleVariantAttribute()
    {
        return $this->products->first();
    }

    public function getUsedVariantAttribute()
    {
        $product = $this->single_variant;

        return $product->variant_id;
    }

    public function getProductInformationAttribute()
    {
        $master = collect($this->products()->withRelationship()->get()->toArray());

        $variants = $master->pluck('details')->flatten(1)->mapToGroups(function ($item, $key) {
            return [$item['variant']['name'] => $item['variant_option']['name']];
        })->map(function ($item, $key) {
            return $item->unique();
        });

        $products = $master->map(function ($item, $key) {
            if ($item['active_discount']) {
                $discountPrice = config('payment.currency_symbol') . (intval($item['price']) - intval($item['discount']['discount_value']));
            } else {
                $discountPrice = null;
            }

            $a = [
                'id' => $item['id'],
                'stock' => $item['stock'],
                'image' => $item['image'] ? $item['image']['url'] : null,
                'active' => $item['active'],
                'price' => config('payment.currency_symbol') . $item['price'],
                'discount_price' => $discountPrice,
            ];

            foreach ($item['details'] as $detail) {
                $a[$detail['variant']['name']] = $detail['variant_option']['name'];
            }

            return $a;
        });

        return [
            'variants' => $variants,
            'products' => $products,
        ];
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
        $products = $this->products;

        $transformed = $products->map(function ($item, $key) {
            if ($discount = $item->active_discount) {
                return [
                    'initial_price' => $item->price,
                    'discount_value' => $discount->discount_value,
                    'final_price' => $item->price - $discount->discount_value,
                ];
            } else {
                return [
                    'initial_price' => $item->price,
                    'discount_value' => 0,
                    'final_price' => $item->price,
                ];
            }
        });

        $max = $transformed->max('final_price');
        $min = $transformed->min('final_price');

        $maxModel = $transformed->firstWhere('final_price', $max);
        $minModel = $transformed->firstWhere('final_price', $min);

        return [
            'min_price' => config('payment.currency_symbol') . $minModel['initial_price'],
            'max_price' => config('payment.currency_symbol') . $maxModel['initial_price'],
            'min_discount' => $minModel['discount_value'],
            'max_discount' => $maxModel['discount_value'],
            'min_final' => config('payment.currency_symbol') . $minModel['final_price'],
            'max_final' => config('payment.currency_symbol') . $maxModel['final_price'],
            'has_stock' => $this->stock > 0 ? true : false,
        ];
    }
}
