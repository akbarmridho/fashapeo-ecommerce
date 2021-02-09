<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\DateTimeCast;

class Transaction extends Model
{
    use HasFactory, Traits\DateTimeSerializer;

    protected $dates = [
        'created_at',
        'updated_at',
        'completed_at',
    ];

    protected $fillable = [
        'order_id',
        'status_id',
        'total',
        'transaction_number',
        'payment_method',
        'completed_at',
    ];

    protected $touches = ['order'];

    protected $casts = [
        'created_at' => DateTimeCast::class,
        'updated_at' => DateTimeCast::class,
        'completed_at' => DateTimeCast::class,
    ];

    public function status()
    {
        return $this->hasOne(Status::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getTransactionTotalAttribute()
    {
        return config('payment.currency_symbol') . $this->total;
    }
}
