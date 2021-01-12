<?php

namespace App\Actions\Product;

use App\Models\MasterProduct;
use App\Models\Customer;
use App\models\Wishlist;

class CreateWishlist {

    public function create(MasterProduct $product, Customer $customer)
    {
        return Wishlist::create([
            'used_id' => $customer->id,
            'master_product_id' => $product->id,
        ]);
    }

}