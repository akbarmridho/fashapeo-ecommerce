<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Actions\Product\CreateNewProduct;
use App\Actions\Product\ProductImage;
use App\Repository\CategoryRepositoryInterface;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class CreatedProductController extends Controller
{
    public $categories;

    public function __construct(CategoryRepositoryInterface $categories)
    {
        $this->categories = $categories;
    }

    public function create()
    {
        $categories = $this->categories->parents();
        $variants = Variant::all();

        return view('admin.pages.create-product', compact('categories', 'variants'));
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

    public function delete(MasterProduct $product, ProductImage $handler)
    {
        $handler->deleteAllImage($product);
        $product->forceDelete();

        session()->flash('status', 'Product Deleted');

        return back();
    }
}