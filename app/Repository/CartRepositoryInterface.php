<?php

namespace App\Repository;

use App\Models\Product;
use App\Models\Customer;
use App\models\Cart;

interface CartRepositoryInterface
{
    public function all();
    
    public function create(Product $product, Customer $customer, int $quantity): Cart;

    public function delete(Cart $cart): Cart;

    public function increment(Cart $cart): Cart;

    public function decrement(Cart $cart): Cart;
}