<?php

namespace App\Actions\Product;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Models\MasterProduct;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\VariantOption;
use App\Models\Variant;
use App\Exceptions\CannotValidateProductId;

class UpdateProduct {

    use ProductImage, ProductValidationRules, UsedVariant;

    public function update(MasterProduct $master, $input)
    {
        Validator::make($input, $this->updateProductValidation($master))->validate();
        
        $this->updateMaster($master, $input);

        if(! $usedVariants = $this->retreiveUsedVariant($input['used_variant'])) {

            foreach($input['variants'] as $variant) {
                $this->updateProduct($variant);
            }

            if(array_key_exists('new_variants', $input)) {

                foreach($input['new_variants'] as $variant) {

                    $product = $this->createProduct($variant, $master);

                    if(array_key_exists('image', $variant)) {
                        $this->productImage($product, $variant['image']);
                    }    
                    
                    foreach($usedVariants as $usedVariant) {
                        $option = $this->createVariantOption(
                            $variant[$usedVariant['name']]
                        );

                        $productDetail = $this->createproductDetail(
                            $product->id,
                            $usedVariant['id'], 
                            $option->id);
                    }

                }

            }

                $ids = Arr::pluck($input['variants'], 'id');
                $this->deleteVariants($master->products()->whereNotIn('id', $ids)->get());

        } else {
            $this->updateProduct($master->products()->first(), $input['variants'][0]);
        }

        $this->mainImages($master, $input['images']);
        
        return $master;
    }

    public function updateMaster(MasterProduct $product, $input)
    {
        return $product->fill([
            'name' => Str::title($input['name']),
            'description' => $input['description'],
            'category_id' => $input['category'],
            'slug' => Str::slug($input['name'], '-'),
            'weight' => $input['weight'],
            'width' => $input['dimensions']['width'],
            'height' => $input['dimensions']['height'],
            'length' => $input['dimensions']['length'],
        ])->save();
    }

    public function updateProduct($input)
    {
        if(! array_key_exists('id', $input)) {
            throw new CannotValidateProductId;
        }

        $product = Product::findOrFail($input['id']);
        $product->fill([
            'stock' => $input['stock'],
           'price' => $input['price'],
           'sku' => $input['sku'],
           'active' => $input['active'],
        ])->save();

        if(array_key_exists('image', $input)) {
            $this->productImage($product, $input['image']);
        }
    }

    public function createProduct(array $input, MasterProduct $master)
    {
        return Product::create([
           'master_product_id' => $master->id,
           'stock' => $input['stock'],
           'price' => $input['price'],
           'sku' => $input['sku'],
           'active' => $input['active'],
       ]);
    }

    public function deleteVariants(Collection $products)
    {
        foreach($products as $product) {
            $this->deleteImage($product->image);
        }

        Product::destroy($products->pluck('id')->all());
    }

    /**
     * Create variant option
     *
     * @param  string  $name
     * @return \App\Models\VariantOption
     */
    public function createVariantOption(string $name)
    {
        return VariantOption::create([
            'name' => Str::title($name),
        ]);
    }

    /**
     * Create new product detail that connect product to its variant options
     *
     * @param  int  $productId
     * @param  int  $variantId
     * @param  int  $variantOptionId
     * @return \App\Models\ProductDetail
     */
    public function createProductDetail(int $productId, int $variantId, int $variantOptionId)
    {
        return ProductDetail::create([
            'product_id' => $productId,
            'variant_id'=> $variantId,
            'variant_option_id' => $variantOptionId,
        ]);
    }
}