<?php

namespace App\Models;

use App\Models\User;
use Parental\HasParent;

class Customer extends User
{
    use HasParent;

    public function wishlists () {
        return $this->hasMany(Wishlist::class);
    }

    public function carts () {
        return $this->hasMany(Cart::class);
    }

    public function addresses () {
        return $this->hasMany(Address::class);
    }

    public function orders () {
        return $this->hasMany(Order::class);
    }
}
