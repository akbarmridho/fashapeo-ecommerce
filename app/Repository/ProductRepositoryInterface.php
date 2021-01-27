<?php

namespace App\Repository;

use App\Models\Category;

interface ProductRepositoryInterface {

    public function search($query);

    public function category(Category $category, $page);

    public function bestSeller();

    public function newArrival($page);

    public function recentViewed();
}