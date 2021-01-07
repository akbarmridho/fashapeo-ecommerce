<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterProduct;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function products() {
        return $this->hasMany(MasterProduct::class);
    }
 
    public function children() {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'id', 'parent_id');
    }
}
