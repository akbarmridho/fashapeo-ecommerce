<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

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

    public function scopeBestSeller($query)
    {
        return $query->orderByDesc('sold');
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
        return $this->images()->where('order', 1)->first();
    }

    // public function getSoldAttribute()
    // {
    //     return $this->
    // }

    public function getMinPriceAttribute()
    {
        return $this->products()->min('price');
    }

    public function getMaxPriceAttribtue()
    {
        return $this->products()->max('price');
    }

    public function getPriceAttribute()
    {
        return $this->calculatePrice();
    }

    protected function calculatePrice()
    {
        $products = $this->products()->without(['details', 'image'])->get();

        $transformed = $products->map(function ($item, $key) {
            $disocunt = $item->active_discount ?: 0;
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
