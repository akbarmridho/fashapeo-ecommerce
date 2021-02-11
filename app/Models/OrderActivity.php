<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Casts\DateTimeCast;

class OrderActivity extends Pivot
{
    protected $fillable = [
        'id',
        'order_id',
        'status_id',
    ];

    protected $casts = [
        'created_at' => DateTimeCast::class,
        'updated_at' => DateTimeCast::class,
    ];

    public $incrementing = true;
}
