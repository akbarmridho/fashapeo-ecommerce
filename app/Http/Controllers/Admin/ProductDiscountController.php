<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDiscount;
use App\Actions\Product\UpdateDiscount;

class ProductDiscountController extends Controller
{
    public function index()
    {
        // return all product with discount option
    }

    public function show()
    {
        // return master product with variations and discount option. 
    }

    public function delete(ProductDiscount $discount)
    {
        $discount->delete();

        session()->flash('status', 'Discount Deleted');

        return back();
    }

    public function update(Request $request, UpdateDiscount $creator)
    {
        foreach($request->products as $product)
        {
            if(! $variant = Product::find($product->id)) {
                $creator->update($variant, $product);
            }
        }

        session()->flash('status', 'Product discount created');

        return back();
    }
}