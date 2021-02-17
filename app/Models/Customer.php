<?php

namespace App\Models;

use Parental\HasParent;
use Illuminate\Support\Facades\Cache;

class Customer extends User
{
    use HasParent;

    public function wishlists()
    {
        return $this->belongsToMany(MasterProduct::class, 'wishlists')->using(Wishlist::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Product::class, 'carts')->using(Cart::class)->withPivot(['quantity', 'note']);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function getActiveAddressAttribute()
    {
        return $this->addresses()->active()->first();
    }

    public function getCartCountAttribute()
    {
        return $this->carts()->count();
    }

    public function getOrderCountAttribute()
    {
        return Cache::remember('order_count.cust' . $this->id, 60 * 15, function () {
            return $this->orders()->whereNull('is_success')->count();
        });
    }
}
