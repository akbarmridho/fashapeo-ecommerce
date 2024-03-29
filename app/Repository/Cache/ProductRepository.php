<?php

namespace App\Repository\Cache;

use App\Models\Category;
use App\Repository\Eloquent\ProductRepository as EloquentProductRepository;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class ProductRepository implements ProductRepositoryInterface
{
    private $parent;
    private $time = 60 * 15;

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

    public function category(Category $category, $page = 1)
    {
        return Cache::tags(['products'])->remember(
            'products.category:' . $category->id . ':page:' . (int) $page,
            $this->time,
            function () use ($category) {
                return $this->parent->category($category);
            }
        );
    }

    public function categoryFilter(Category $category, $min, $max)
    {
        return $this->parent->categoryFilter($category, $min, $max);
    }

    public function categorySearch(Category $category, $term)
    {
        return $this->parent->categorySearch($category, $term);
    }

    public function findBySlug($product)
    {
        return Cache::tags(['products'])->remember('products.slug.' . $product, $this->time, function () use ($product) {
            return $this->parent->findBySlug($product);
        });
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
        $lists = Cookie::get('lastVisited');

        $result = collect([]);

        foreach (explode(',', $lists) as $slug) {
            $result->push($this->findBySlug($slug));
        }

        return $result;
    }
}
