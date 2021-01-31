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

    public function show(MasterProduct $product)
    {
        $firstVariant = $product->products()->first();
        $categories = $this->categories->parents();

        if ($firstVariant->variant_count === 0) {
            return view('admin.pages.edit-single-variant-product', ['categories' => $categories, 'master' => $product]);
        } else if ($product->variant_count > 0) {
            $variants = $product->variants;
            return view('admin.pages.edit-multi-variant-product', ['categories' => $categories, 'master' => $product, 'variants' => $variants]);
        }
    }

    public function update(MasterProduct $product, Request $request, UpdateProduct $updater)
    {
        $updater->update($product, $request->all());
        return response()->json(['message' => 'Product updated'], 200);
    }
}
