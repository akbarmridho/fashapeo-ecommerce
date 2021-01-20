<?php

namespace App\Actions\Product;

use App\Models\MasterProduct;
use App\Models\Product;
use App\Models\Image;
use App\Actions\Vendor\Filepond;
use Illuminate\Support\Facades\Storage;
use App\Transformers\FilepondImageSerializer as Serializer;

trait ProductImage
{
    public function mainImages(MasterProduct $product, array $images)
    {
        $filepond = new Filepond;
        $serialized = Serializer::convert($images);
        $productImages = $product->images();

        if(! empty($serialized['old'])) {
            $filtered = $productImages->whereNotIn('order', $serialized['old'])->get();
            $this->deleteImagesFromList($filtered);
        }

        foreach($serialized['images'] as $index => $image)
        {
            $imagePath = config('image.product_img_path');
            if($image['isNew']) {

                $filepond->move($image['id'], $image['filename'], $imagePath);
                $product->images()->create([
                    'url' => $imagePath . DIRECTORY_SEPARATOR . $image['filename'],
                    'order' => (int) $index,
                ]);

            } else {

                $image = $productImages->where('order', $image['id'])->firstOrFail();
                $image->fill(['order' => $index])->save();

            }
        }
        
        if (! empty($serialized['ids'])) {
            $filepond->deleteTemporaryPath($serialized['ids']);
        }
    }

    public function productImage(Product $product, $image)
    {
        $filepond = new Filepond;
        $imagePath = config('image.product_img_path');
        if(! $image = json_decode($image)) {

            $filepond->move($image['id'], $image['filename'], $imagePath);
            $filepond->deleteTemporaryPath($image['id']);
            $product->image->updateOrCreate([
                'url' => $imagePath . DIRECTORY_SEPARATOR . $image['filename'],
            ]);
            
        }
    }

    public function deleteImagesFromList($images)
    {
        foreach($images as $image) {
            Storage::disk('public')->delete($image->url);
        }

        Image::destroy($images->pluck('id')->all());
    }
}