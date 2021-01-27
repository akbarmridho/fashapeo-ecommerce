<?php

namespace App\Repository\Cache;

use App\Repository\ProductRepositoryInterface;
use App\Repository\Eloquent\ProductRepository as EloquentProductRepository;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Models\MasterProduct;

class ProductRepository implements ProductRepositoryInterface
{
    private $parent;
    private $time = 60*60*24*30;

    public function __construct(EloquentProductRepository $parent)
    {
        $this->parent = $parent;
    }

    public function search($query)
    {
        return $this->parent->search($query);
    }

    public function category(Category $category, $page)
    {
        return Cache::tags(['products'])->remember('products.category:' . $category->id . ':page:' . (int) $page, $this->time, 
        function($category, $page) {
            return $this->parent->category($category, $page);
        });
    }

    public function bestSeller()
    {
        return Cache::tags(['products'])->remember('products.best_seller', $this->time,
        function() {
            return $this->parent->bestSeller();
        });
    }

    public function newArrival($page)
    {
        return Cache::tags(['products'])->remember('products.new_arrival:page:' . (int) $page, $this->time, 
        function($page){
            return $this->parent->newArrival($page);
        });
    }

    public function recentViewed()
    {
        return $this->parent->recentViewed();
    }
}