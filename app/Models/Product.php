<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function masterProduct () {
        return $this->belongsTo(MasterProduct::class);
    }

    public function details () {
        return $this->hasMany(ProductDetail::class);
    }

    public function image () {
        return $this->morphTo(Image::class, 'imageable');
    }
}
