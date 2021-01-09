<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function variant () {
        return $this->hasOne(Variant::class);
    }

    public function variantOption () {
        return $this->hasOne(Variant::class);
    }
}
