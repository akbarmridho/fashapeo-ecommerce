<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'label',
        'name',
        'province',
        'city',
        'district',
        'postal_code',
        'delivery_address',
        'phone',
        'rajaongkir_id',
        'isMain',
    ];

    public function addressable ()
    {
        return $this->morphTo();
    }

    public function scopeActive($query)
    {
        return $query->where('isMain', true);
    }
}
