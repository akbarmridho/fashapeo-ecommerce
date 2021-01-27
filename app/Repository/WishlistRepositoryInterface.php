<?php

namespace App\Repository;

use App\Models\MasterProduct;
use App\Models\Customer;
use App\Models\Wishlist;

interface WishlistRepositoryInterface
{
    public function create(MasterProduct $product, Customer $customer): Wishlist;
    public function delete(Wishlist $wishlist);
}