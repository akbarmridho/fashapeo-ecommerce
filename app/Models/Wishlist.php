<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Wishlist extends Pivot
{
    protected $fillable = [
        'user_id',
        'master_product_id',
    ];

    public $timestamps = false;

    public $incrementing = true;
}
