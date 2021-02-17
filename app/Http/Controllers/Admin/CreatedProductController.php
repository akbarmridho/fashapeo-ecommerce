<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Product\CreateNewProduct;
use App\Actions\Product\ProductImage;
use App\Http\Controllers\Controller;
use App\Models\MasterProduct;
use App\Models\Variant;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CreatedProductController extends Controller
{
    use ProductImage;

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
        $product = $creator->create($request->all());

        Cache::tags('products')->flush();

        session()->flash('status', 'Product created');

        return response()->json(['message' => 'Product created'], 200);
    }

    public function archive(MasterProduct $product)
    {
        $product->delete();

        Cache::tags('products')->flush();

        session()->flash('status', 'Product Archived');

        return back();
    }

    public function delete(MasterProduct $product)
    {
        $this->deleteAllImage($product);
        $product->forceDelete();
        session()->flash('status', 'Product Deleted');

        return back();
    }

    public function restore($product)
    {
        $master = MasterProduct::withTrashed()->find(($product));
        $master->restore();
        session()->flash('status', 'Product restored');

        return back();
    }
}
