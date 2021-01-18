<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

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

    public function status()
    {
        return $this->hasOne(Status::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
