<?php

namespace App\Repository\Cache;

use App\Models\Category;
use App\Repository\Eloquent\ProductRepository as EloquentProductRepository;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class ProductRepository implements ProductRepositoryInterface
{
    private $parent;
    private $time = 60 * 60 * 24 * 30;

    public function __construct(EloquentProductRepository $parent)
    {
        $this->parent = $parent;
    }

    public function all($page)
    {
        return Cache::tags(['products'])->remember('products.all:page:' . (int) $page, 60 * 60, function ($page) {
            return $this->parent->all();
        });
    }

    public function archived($page)
    {
        return Cache::tags(['products'])->remember('products.archived:page:' . (int) $page, 60 * 60, function () {
            return $this->parent->archived();
        });
    }

    public function search($query)
    {
        return $this->parent->search($query);
    }

    public function category(Category $category, $page)
    {
        return Cache::tags(['products'])->remember(
            'products.category:' . $category->id . ':page:' . (int) $page,
            $this->time,
            function ($category) {
                return $this->parent->category($category);
            }
        );
    }

    public function bestSeller()
    {
        return Cache::tags(['products'])->remember(
            'products.best_seller',
            $this->time,
            function () {
                return $this->parent->bestSeller();
            }
        );
    }

    public function newArrival()
    {
        return Cache::tags(['products'])->remember(
            'products.new_arrival',
            $this->time,
            function () {
                return $this->parent->newArrival();
            }
        );
    }

    public function recentViewed()
    {
        return $this->parent->recentViewed();
    }
}
