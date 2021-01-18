<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'code'
    ];
}
