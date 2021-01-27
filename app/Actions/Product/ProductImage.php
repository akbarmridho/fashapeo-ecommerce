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

        if(array_key_exists('old', $serialized) && ! empty($serialized['old'])) {
            $filtered = $productImages->whereNotIn('url', $serialized['old'])->get();
            $this->deleteImagesFromList($filtered);
        }

        foreach($serialized['images'] as $index => $image)
        {
            $imagePath = config('image.product_img_path');
            if($image['is_new']) {

                $newPath = $filepond->move($image['content'], $imagePath);
                $product->images()->create([
                    'url' => $newPath,
                    'order' => (int) $index,
                ]);

            } else {

                $image = $productImages->where('url', $image['content'])->firstOrFail();
                $image->fill(['order' => $index])->save();

            }
        }
    }

    public function productImage(Product $product, string $image)
    {
        $filepond = new Filepond;
        $imagePath = config('image.product_img_path');

        if(\is_dir($image)) {
            $newPath = $filepond->move($image, $imagePath);
            $product->image->updateOrCreate([
                'url' => $newPath,
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

    public function deleteAllImage(MasterProduct $master)
    {
        foreach($master->images as $image) {
            $this->deleteImage($image);
        }

        foreach($master->products as $product) {
            $this->deleteImage($product->image);
        }
    }

    private function deleteImage(Image $image)
    {
        Storage::disk('public')->delete($image->url);
        $image->delete();
    }
}