<?php

namespace App\Actions\Product;

use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use App\Models\Product;
use App\Models\MasterProduct;

class ProductImageDelete
{
    public function delete(MasterProduct $master)
    {
        foreach($master->images as $image) {
            $this->imageDelete($image);
        }

        foreach($master->products as $product) {
            $this->imageDelete($product->image);
        }
    }

    private function imageDelete(Image $image)
    {
        Storage::disk('public')->delete($image->url);
        $image->delete();
    }
}