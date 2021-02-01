<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Repository\CartRepositoryInterface as Carts;

class CartController extends Controller
{
    public $carts;

    public function __construct(Carts $carts)
    {
        $this->carts = $carts;
    }

    public function show()
    {
        return view('customer.pages.cart');
    }

    public function increment(Cart $cart)
    {
        $this->carts->increment($cart);
    }

    public function decrement(Cart $cart)
    {
        $this->carts->decrement($cart);
    }

    public function delete(Cart $cart)
    {
        $this->carts->delete($cart);
    }
}
