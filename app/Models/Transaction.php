<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    private $fillable = [
        'transaction_number',
        'name',
        'payment_method',
        'total',
    ];

    public function transactionStatus ()
    {
        return $this->hasOne(Status::class);
    }
}
