<?php

namespace App\Repository\Eloquent;

use App\Repository\ProductRepositoryInterface;
use App\Models\Category;
use App\Models\MasterProduct;
use Illuminate\Support\Cookie;

class ProductRepository implements ProductRepositoryInterface {

    public $paginate = 8;
    public $master;

    public function __construct(MasterProduct $master)
    {
        $this->master = $master;
    }

    public function search($query)
    {
        return $this->master->search($query)->paginate($this->paginate);
    }

    public function category(Category $category, $page)
    {
        return $category->products()->withRelationship()->paginate($this->paginate);
    }

    public function bestSeller($page)
    {
        return $this->master->withRelationship()->bestSeller()->paginate($this->paginate);
    }

    public function newArrival($page)
    {
        return $this->master->withRelationship()->newArrival()->paginate($this->paginate);
    }

    public function recentViewed()
    {
        $lists = Cookie::get('lastVisited');
        return $this->master->withRelationship()->findMany(explode(',', $lists));
    }
}