<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Product\UpdateProduct;
use App\Http\Controllers\Controller;
use App\Models\MasterProduct;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UpdateProductController extends Controller
{
    public $categories;

    public function __construct(CategoryRepositoryInterface $categories)
    {
        $this->categories = $categories;
    }

    public function show(MasterProduct $product)
    {
        $firstVariant = $product->products()->first();
        $categories = $this->categories->parents();

        if ($firstVariant->variant_count === 0) {
            return view('admin.pages.edit-single-variant-product', ['categories' => $categories, 'master' => $product]);
        } elseif ($firstVariant->variant_count > 0) {
            $variants = $firstVariant->variants;

            return view('admin.pages.edit-multi-variant-product', ['categories' => $categories, 'master' => $product, 'variants' => $variants]);
        }
    }

    public function update(MasterProduct $product, Request $request, UpdateProduct $updater)
    {
        $updater->update($product, $request->all());
        Cache::tags('products')->flush();
        session()->flash('status', 'Product Updated');

        return response()->json(['message' => 'Product updated'], 200);
    }
}
