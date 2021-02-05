<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Repository\CartRepositoryInterface as Carts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function add(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|gt:0'
        ]);

        $product = Product::findOrFail($validated['id']);

        if ($validated['quantity'] > $product->stock) {
            $quantity = $product->stock;
        } else {
            $quantity = $validated['quantity'];
        }

        $customer = Auth::guard('customer')->user();

        $cartCount = $customer->carts()->where('product_id', $validated['id'])->count();

        if ($cartCount === 0) {
            $this->carts->create($product, $customer, $quantity);
        } else {
            return response(['message' => 'Cart already exist'], 422);
        }
    }

    public function increment(Cart $cart)
    {
        if ($cart->quantity + 1 <= $cart->product->stock) {
            $this->carts->increment($cart);
        }
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
