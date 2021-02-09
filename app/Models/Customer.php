<?php

namespace App\Models;

use Parental\HasParent;

class Customer extends User
{
    use HasParent;

    public function wishlists()
    {
        return $this->belongsToMany(MasterProduct::class)->using(Wishlist::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Product::class)->using(Cart::class)->withPivot(['quantity', 'note']);
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
}
