<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function show()
    {
        $customer = Auth::guard('customer')->user();
        $products = $customer->carts()->withRelationship()->get();

        $initialPrice = $products->sum('price');
        $discountPrice = $products->sum('discount.discount_value') ?: 0;

        $summary = [
            'items' => config('payment.currency_symbol') . $initialPrice,
            'discount' => config('payment.currency_symbol') . $discountPrice,
            'total' => config('payment.currency_symbol') . ($initialPrice - $discountPrice),
        ];

        return view('customer.pages.cart', compact('products', 'summary'));
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

        if ($customer->carts()->where('product_id', $validated['id'])->exists()) {
            return response('Duplicate cart', 422);
        }

        $customer->carts()->syncWithoutDetaching([$validated['id'] => ['quantity' => $quantity]]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|gte:1',
            'note' => 'string|nullable',
        ]);

        $customer = Auth::guard('customer')->user();

        $customer->carts()->updateExistingPivot($validated['id'], ['quantity' => $validated['quantity'], 'note' => $validated['note']]);
    }

    public function delete($id)
    {
        $customer = Auth::guard('customer')->user();
        $customer->carts()->detach($id);
    }
}
