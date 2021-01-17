<?php

namespace App\Actions\Product;

use App\Models\MasterProduct;
use App\Models\Product;
use App\Actions\Vendor\Filepond;
use App\Transformers\FilepondImageSerializer as Serializer;

trait ProductImage
{
    public function mainImages(MasterProduct $product, array $images)
    {
        $filepond = new Filepond;
        $serialized = Serializer::convert($images);
        $productImages = $product->images;

        if($productImages->isNotEmpty()) {
            foreach($productImages as $productImage) {
                $productImage->delete();
            }
        }

        foreach($serialized['images'] as $index => $image)
        {
            $filepond->move($image['id'], $image['filename'], config('image.product_img_path'));
            
            $product->images()->create([
                'url' => $image['filename'],
                'order' => (int) $index,
            ]);
        }
        
        $filepond->deleteTemporaryPath($serialized['ids']);
    }

    public function productImage(Product $product, $image)
    {
        $filepond = new Filepond;
        $image = json_decode($image);
        $filepond->move($image['id'], $image['filename'], config('image.product_img_path'));
        $filepond->deleteTemporaryPath($image['id']);

        $product->image->updateOrCreate([
            'url' => $image['filename'],
        ]);
    }
}