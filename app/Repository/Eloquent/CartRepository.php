<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Cart;
use App\Repository\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{

    public $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function all()
    {
        return $this->cart->all();
    }

    public function create (Product $product, Customer $customer, int $quantity): Cart
    {
        return Cart::create([
            'user_id' => $customer->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);
    }

    public function delete (Cart $cart)
    {
        return $cart->delete();
    }

    public function increment (Cart $cart): Cart
    {
        $cart->quantity++;
        $cart->save();

        return $cart;
    }

    public function decrement (Cart $cart): Cart
    {
        $cart->quantity--;
        $cart->save();

        return $cart;
    }
}