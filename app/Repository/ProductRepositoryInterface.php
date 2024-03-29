<?php

namespace App\Repository;

use App\Models\Category;

interface ProductRepositoryInterface
{
    public function all($page);

    public function archived($page);

    public function search($query);

    public function category(Category $category, $page);

    public function categoryFilter(Category $category, $min, $max);

    public function categorySearch(Category $category, $term);

    public function findBySlug($product);

    public function bestSeller();

    public function newArrival();

    public function recentViewed();
}
