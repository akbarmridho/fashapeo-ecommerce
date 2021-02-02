<?php

namespace App\Models;

use App\Models\MasterProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
    ];

    public function products()
    {
        return $this->hasMany(MasterProduct::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function scopeParents($query)
    {
        return $query->where('parent_id', null);
    }

    public function scopeChildren($query)
    {
        return $query->where('parent_id', '!=', null);
    }

    public function scopeWithChildren($query)
    {
        return $query->with('children');
    }
}
