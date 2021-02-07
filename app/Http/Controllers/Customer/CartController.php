<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductDetail;
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
        $customer = Auth::guard('customer')->user();
        $products = $customer->carts;

        return view('customer.pages.cart', compact('products'));
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

        $customer->carts()->syncWithoutDetaching([$validated['id'] => ['quantity' => $validated['quantity']]]);
    }

    public function increment($cart)
    {
        $customer = Auth::guard('customer')->user();
        $customer->carts()->find($cart)->pivot->increment('quantity');
    }

    public function decrement($cart)
    {
        $customer = Auth::guard('customer')->user();
        $customer->carts()->find($cart)->pivot->increment('quantity');
    }

    public function delete($cart)
    {
        $customer->carts()->detach($cart);
    }
}
