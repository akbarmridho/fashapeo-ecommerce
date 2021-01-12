<?php

namespace App\Actions\Product;

use App\Models\Product;
use App\Models\Customer;
use App\models\Cart;

class UpdateCart {

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