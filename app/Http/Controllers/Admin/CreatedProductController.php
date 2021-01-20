<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Product\CreateNewProduct;
use Illuminate\Support\Facades\DB;

class CreatedProductController extends Controller
{
    public function create()
    {
        //
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

        session()->flash('status', 'Product created');

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