<?php

namespace App\Actions\Product;

use App\Actions\Vendor\Filepond;
use App\Models\Image;
use App\Models\MasterProduct;
use App\Models\Product;
use App\Transformers\FilepondImageSerializer as Serializer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

trait ProductImage
{
    public function mainImages(MasterProduct $product, array $images)
    {
        $filepond = new Filepond;
        $serialized = Serializer::convert($images);
        $productImages = $product->images();

        if (array_key_exists('old', $serialized) && !empty($serialized['old'])) {
            $filtered = $productImages->whereNotIn('id', $serialized['old'])->get();
            $this->deleteImagesFromList($filtered, config('image.product_img_path'));
        }

        foreach ($serialized['images'] as $index => $image) {
            $imagePath = config('image.product_img_path');
            if ($image['is_new']) {
                $newPath = $filepond->move($image['content'], $imagePath);
                $product->images()->create([
                    'url' => $newPath,
                    'order' => (int) $index,
                ]);
            } else {
                $image = Image::findOrFail((int) $image['content']);

                $image->fill(['order' => $index])->save();
            }
        }
    }

    public function productImage(Product $product, string $image)
    {
        $filepond = new Filepond;
        $imagePath = config('image.product_img_path');

        $serialized = Serializer::convert([$image]);

        foreach ($serialized['images'] as $img) {
            if ($img['is_new']) {
                $newPath = $filepond->move($img['content'], $imagePath);
                if ($product->image) {
                    $product->image->fill(['url' => $newPath])->save();
                } else {
                    $product->image()->create(['url' => $newPath]);
                }
            }
        }
    }

    public function deleteImagesFromList(Collection $images, $pathPrefix = null)
    {
        if ($images->isEmpty()) {
            return;
        }

        $nameList = $images->pluck('url');
        $nameList->transform(function ($item, $key) use ($pathPrefix) {
            if ($pathPrefix === null) {
                return \basename($item);
            }

            return $pathPrefix . DIRECTORY_SEPARATOR . \basename($item);
        });

        if (!(config('image.img_disk') === 'local' || config('image.img_disk') === 'public')) {
            Storage::disk(config('image.img_disk'))->delete($nameList->all());
        } else {
            Storage::disk('public')->delete($nameList->all());
        }

        Image::destroy($images->pluck('id')->all());
    }

    public function deleteAllImage(MasterProduct $master)
    {
        $this->deleteImagesFromList($master->images, config('image.product_img_path'));

        foreach ($master->products as $product) {
            $this->deleteImage($product->image, config('image.product_img_path'));
        }
    }

    private function deleteImage(Image $image, $pathPrefix = null)
    {
        if ($pathPrefix === null) {
            $path = \basename($image->url);
        } else {
            $path = $pathPrefix . DIRECTORY_SEPARATOR . \basename($image->url);
        }

        if (!(config('image.img_disk') === 'local' || config('image.img_disk') === 'public')) {
            Storage::disk(config('iamge.img_disk'))->delete($path);
        } else {
            Storage::disk('public')->delete($path);
        }
        $image->delete();
    }
}
