<?php

namespace App\Repository;

use App\Models\Category;

interface ProductRepositoryInterface {

    public function all();

    public function category(Category $category);

    public function bestSeller();

    public function newArrival();

    public function recentViewed();
}