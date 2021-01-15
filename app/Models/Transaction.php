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

    private $fillable = [
        'order_id',
        'status_id',
        'total',
        'transaction_number',
        'payment_method',
        'token',
        'completed_at',
    ];

    public function status ()
    {
        return $this->hasOne(Status::class);
    }
}
