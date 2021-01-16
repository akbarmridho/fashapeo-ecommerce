<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Actions\Product\UpdateDiscount;

class ProductDiscountController extends Controller
{
    public function index()
    {
        // return all product with discount option
    }

    public function product()
    {
        // return master product with variations and discount option. 
    }

    public function update(Request $request, UpdateDiscount $creator)
    {
        foreach($request->products as $product)
        {
            if(! $variant = Product::find($product->id)) {
                $creator->update($variant, $product);
            }
        }

        session()->flash('status', 'Product discoutn created');

        return back();
    }
}