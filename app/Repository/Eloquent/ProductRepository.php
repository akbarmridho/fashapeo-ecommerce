<?php

namespace App\Repository\Eloquent;

use App\Models\Category;
use App\Models\MasterProduct;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Facades\Cookie;

class ProductRepository implements ProductRepositoryInterface
{
    public $paginate = 8;
    public $master;

    public function __construct(MasterProduct $master)
    {
        $this->master = $master;
    }

    public function all($page = null)
    {
        return $this->master->orderByDesc('created_at')->paginate(10);
    }

    public function archived($page = null)
    {
        return $this->master->onlyTrashed()->paginate(10);
    }

    public function search($query)
    {
        return $this->master->search($query)->paginate($this->paginate);
    }

    public function category(Category $category, $page = null)
    {
        // children
        if ($category->parent_id) {
            return MasterProduct::where('category_id', $category->id)->withRelationship()->paginate($this->paginate);
        }
        // parent
        return MasterProduct::whereIn('category_id', $category->children->plucK('id'))->withRelationship()->paginate($this->paginate);
    }

    public function bestSeller()
    {
        return $this->master->withRelationship()->all()->sortByDesc('sold')->take(8);
    }

    public function newArrival()
    {
        return $this->master->withRelationship()->newArrival()->paginate($this->paginate);
    }

    public function recentViewed()
    {
        $lists = Cookie::get('lastVisited');

        return $this->master->withRelationship()->findMany(array_map('intval', explode(',', $lists)));
    }
}
