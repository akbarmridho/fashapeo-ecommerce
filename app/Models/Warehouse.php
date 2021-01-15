<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'main',
    ];

    public $timestamps = false;

    public function address ()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function scopeActive ($query)
    {
        return $query->where('main', true);
    }

}