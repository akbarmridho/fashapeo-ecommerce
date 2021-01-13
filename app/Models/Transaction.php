<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    private $fillable = [
        'order_id',
        'total',
    ];

    public function status ()
    {
        return $this->hasOne(Status::class);
    }
}
