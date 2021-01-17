<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Product\CreateNewProduct;

class CreatedProductController extends Controller
{
    public function create()
    {
        //
    }

    public function store(CreateNewProduct $creator, Request $request)
    {
        $product = $creator->create($request->all());

        session()->flash('status', 'Product uploaded');

        return redirect()->route('admin.products');
    }

    public function archive(MasterProduct $product)
    {
        $product->delete();

        session()->flash('status', 'Product Archived');

        return back();
    }

    public function delete(MasterProduct $product, Image $handler)
    {
        $handler->delete($product);
        $product->forceDelete();

        session()->flash('status', 'Product Deleted');

        return back();
    }
}