<?php

namespace App\Actions\Product;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\MasterProduct;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\VariantOption;
use App\Models\Variant;

class CreateNewProduct
{
    use ProductValidationRules, UsedVariant, ProductImage;

    /**
     * Validate and create a new product and its related models
     *
     * @param  array  $input
     * @return \App\Models\MasterProduct
     */
    public function create (array $input)
    {
        Validator::make($input, $this->createProductValidation())->validate();

        $masterProduct = $this->createMasterProduct($input);

        $usedVariants = $this->retreiveUsedVariant($input['used_variant']);

        $this->mainImages($masterProduct, $input['images']);

        if(! $usedVariants) {
            $product = $this->createProduct($input['variants'][0], $masterProduct);

            return $masterProduct;
        }

        foreach($input['variants'] as $variant) {

            $product = $this->createProduct($variant, $masterProduct);

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

        return $masterProduct;
    }

    /**
     * Create a new master product
     *
     * @param  array  $input
     * @return \App\Models\MasterProduct
     */
    public function createMasterProduct(array $input)
    {
        return MasterProduct::create([
                'name' => Str::title($input['name']),
                'description' => $input['description'],
                'category_id' => $input['category'],
                'slug' => Str::slug($input['name'], '-'),
                'weight' => $input['weight'],
                'width' => $input['dimensions']['width'],
                'height' => $input['dimensions']['height'],
                'length' => $input['dimensions']['length'],
            ]);
    }

    /**
     * Create new product
     *
     * @param  array  $input
     * @param MasterProduct $master
     * @return \App\Models\Product
     */
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