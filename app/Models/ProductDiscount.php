<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ProductDiscount extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at',
        'valid_until',
    ];

    protected $fillable = [
        'product_id',
        'discount_value',
        'valid_until',
    ];

    protected $touches = ['product'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->whereDate('valid_until', '<', Carbon::now())->orWhereNull('valid_until');
    }
}
