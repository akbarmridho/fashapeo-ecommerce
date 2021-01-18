<?php

namespace App\Repository\Eloquent;

use App\Models\MasterProduct;
use App\Models\Customer;
use App\Models\Wishlist;
use App\Repository\WishlistRepositoryInterface;

class WishlistRepository implements WishlistRepositoryInterface
{
    public $wishlist;

    public function __construct(Wishlist $wishlist)
    {
        $this->wishlist = $wishlist;
    }

    public function create(MasterProduct $product, Customer $customer): Wishlist
    {
        return Wishlist::create([
            'used_id' => $customer->id,
            'master_product_id' => $product->id,
        ]);
    }

    public function delete(Wishlist $wishlist): Wishlist
    {
        return $wishlist->delete();
    }

}