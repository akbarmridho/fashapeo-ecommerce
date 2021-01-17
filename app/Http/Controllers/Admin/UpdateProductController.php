<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Product\UpdateProduct;
use App\Actions\Product\ProductImageDelete as Image;

class UpdateProductController extends Controller
{
    public function show()
    {
        //
    }

    public function update(MasterProduct $product, Request $request, UpdateProduct $updater)
    {
        //
    }
    
    public function masterImages(MasterProduct $master)
    {
        // copy all master product to new temp folder
        // return folder id and filename
    }

    public function productImage(Product $product)
    {
        // copy product image to new temp folder
        // return folder id and filename
    }
}