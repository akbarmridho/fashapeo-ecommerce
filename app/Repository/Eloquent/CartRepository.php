<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
use App\Models\Customer;
use App\models\Cart;

class CartRepository {

    public $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function all()
    {
        return $this->cart->all();
    }

    public function create (Product $product, Customer $customer, int $quantity)
    {
        return Cart::create([
            'used_id' => $customer_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
        ]);
    }

    public function delete (Cart $cart)
    {
        return $cart->delete();
    }

    public function increment (Cart $cart)
    {
        $cart->quantity++;
        $cart->save();

        return $cart;
    }

    public function decrement (Cart $cart)
    {
        $cart->quantity--;
        $cart->save();

        return $cart;
    }
}