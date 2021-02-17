<?php

namespace App\Repository\Cache;

use App\Repository\CategoryRepositoryInterface;
use App\Repository\Eloquent\CategoryRepository as EloquentCategoryRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryRepository implements CategoryRepositoryInterface
{
    public $parent;
    private $time = 60 * 15;

    public function __construct(EloquentCategoryRepository $parent)
    {
        $this->parent = $parent;
    }

    public function all(): Collection
    {
        return Cache::tags(['categories'])->remember('categories', $this->time, function () {
            return $this->parent->all();
        });
    }

    public function children(): Collection
    {
        return Cache::tags(['categories'])->remember('categories.children', $this->time, function () {
            return $this->parent->children();
        });
    }

    public function parents(): Collection
    {
        return Cache::tags(['categories'])->remember('categories.parents', $this->time, function () {
            return $this->parent->parents();
        });
    }
}
