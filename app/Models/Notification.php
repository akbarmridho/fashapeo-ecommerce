<?php

namespace App\Models;

use Illuminate\Notifications\DatabaseNotification as BaseNotification;
use App\Casts\DateDifferenceCast;

class Notification extends BaseNotification
{
    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
        'created_at' => DateDifferenceCast::class,
    ];
}
