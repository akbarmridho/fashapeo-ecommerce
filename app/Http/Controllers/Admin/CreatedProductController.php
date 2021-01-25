<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Product\CreateNewProduct;
use App\Actions\Product\ProductImageDelete;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class CreatedProductController extends Controller
{
    public function create()
    {
        return view('admin.pages.create-product');
    }

    public function store(CreateNewProduct $creator, Request $request)
    {
        DB::beginTransaction();
        try {
            $product = $creator->create($request->all());
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => 'Cannot create product'], 500);
        }

        DB::commit();

        Cache::tags('products')->flush();

        session()->flash('status', 'Product created');

        return redirect()->route('admin.products');
    }

    public function archive(MasterProduct $product)
    {
        $product->delete();

        Cache::tags('products')->flush();

        session()->flash('status', 'Product Archived');

        return back();
    }

    public function delete(MasterProduct $product, ProductImageDelete $handler)
    {
        $handler->delete($product);
        $product->forceDelete();

        session()->flash('status', 'Product Deleted');

        return back();
    }
}