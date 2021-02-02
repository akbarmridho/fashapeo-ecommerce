<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\DateTimeCast;

class OrderActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'status_id',
    ];

    protected $touches = ['order'];

    protected $casts = [
        'created_at' => DateTimeCast::class,
        'updated_at' => DateTimeCast::class,
    ];

    public function status()
    {
        return $this->hasOne(Status::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
