<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterProduct extends Model
{
    use HasFactory, SoftDeletes;

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

    public function products () {
        return $this->hasMany(Product::class);
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }
}
