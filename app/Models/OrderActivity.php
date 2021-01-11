<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderActivity extends Model
{
    use HasFactory;

    private $fillable = [
        'order_id',
        'status_id',
        'description',
    ];

    public function status ()
    {
        return $this->hasOne(Status::class);
    }
}
