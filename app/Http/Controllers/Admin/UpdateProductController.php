<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Actions\Product\UpdateProduct;
use App\Models\MasterProduct;

class UpdateProductController extends Controller
{
    public function show()
    {
        //
    }

    public function update(MasterProduct $product, Request $request, UpdateProduct $updater)
    {
        DB::beginTransaction();

        try {
            $updater->update($product, $request->all());
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => 'An error occured. Please check logs'], 500);
        }

        DB::commit();

        return response()->json(['message' => 'Product updated'], 200);
    }
    
    /*
     * retreived get parameter should
     * refer to image order
     */
    public function masterImages(MasterProduct $master, Request $request)
    {
        $image = $master->images()->where('order', (int) $request->load)->first();
        $path = Storage::disk('public')->path($image->url);

        return response()->file($path);
    }

    /*
     * retreived get parameter load should
     * refer to product id
     */
    public function productImage(MasterProduct $master, Request $request)
    {
        $product = $master->products()->find((int) $request->load);
        $path = Storage::disk('public')->path($product->image->url);

        return response()->file($path);
    }
}