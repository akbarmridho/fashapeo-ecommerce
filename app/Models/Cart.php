<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Cart extends Pivot
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'note'
    ];

    protected $with = ['product'];

    public $timestamps = false;

    public $incrementing = true;
}
