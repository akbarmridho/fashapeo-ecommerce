<?php

namespace App\Actions\Product;

use Illuminate\Support\Facades\Validator;
use App\Models\MasterProduct;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\VariantOption;
use App\Models\Variant;
use Illuminate\Support\Str;

class CreateNewProduct {

    use ProductValidationRules;

    public function create (array $input)
    {
        Validator::make($input, $this->masterProductValidation())->validate();

        $masterProduct = $this->createMasterProduct($input);

        foreach($input['variants'] as $variant) {
            // assosiasi product detail, variant options, dan product
        } 
    }

    public function createMasterProduct(array $input)
    {
        return MasterProduct::create([
                'name' => Str::title($input['name']),
                'description' => $input['description'],
                'category_id' => $input['category_id'],
                'slug' => Str::slug($input['name'], '-'),
                'weight' => $input['weight'],
            ]);
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

    public function createVariantOption()
    {
        // use transactions
    }

    public function createProductDetail()
    {
        //
    }

    


}