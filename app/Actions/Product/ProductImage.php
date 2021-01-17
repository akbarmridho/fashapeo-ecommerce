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
            $imagePath = config('image.product_img_path');
            $filepond->move($image['id'], $image['filename'], $imagePath);
            
            $product->images()->create([
                'url' => $imagePath . DIRECTORY_SEPARATOR . $image['filename'],
                'order' => (int) $index,
            ]);
        }
        
        $filepond->deleteTemporaryPath($serialized['ids']);
    }

    public function productImage(Product $product, $image)
    {
        $filepond = new Filepond;
        $imagePath = config('image.product_img_path');
        $image = json_decode($image);
        $filepond->move($image['id'], $image['filename'], $imagePath);
        $filepond->deleteTemporaryPath($image['id']);

        $product->image->updateOrCreate([
            'url' => $imagePath . DIRECTORY_SEPARATOR . $image['filename'],
        ]);
    }
}