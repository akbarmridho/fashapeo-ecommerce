<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'user_id',
        'province',
        'city',
        'district',
        'postal_code',
        'delivery_address',
    ];

    public function addressable ()
    {
        return $this->morphTo();
    }
}
