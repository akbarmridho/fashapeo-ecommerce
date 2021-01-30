<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Product\UpdateProduct;
use App\Models\MasterProduct;
use App\Repository\CategoryRepositoryInterface;

class UpdateProductController extends Controller
{
    public $categories;

    public function __construct(CategoryRepositoryInterface $categories)
    {
        $this->categories = $categories;
    }

    public function show(MasterProduct $master)
    {
        $product = $master->products()->first();
        $categories = $this->categories->parents();

        if ($product->number_of_variant === 0) {
            return view('admin.pages.edit-single-variant-product', compact('categories', 'master'));
        } else if ($product->number_of_variant > 0) {
            $variants = $product->variants;
            return view('admin.pages.edit-multi-variant-product', compact('categories', 'master', 'variants'));
        }
    }

    public function update(MasterProduct $product, Request $request, UpdateProduct $updater)
    {
        $updater->update($product, $request->all());
        return response()->json(['message' => 'Product updated'], 200);
    }
}
