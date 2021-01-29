<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderActivity extends Model
{
    use HasFactory, Traits\DateTimeSerializer;

    protected $fillable = [
        'order_id',
        'status_id',
    ];

    protected $touches = ['order'];

    public function status()
    {
        return $this->hasOne(Status::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
