<?php

namespace App\Repository\Cache;

use App\Models\Category;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\Eloquent\CategoryRepository as EloquentCategoryRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryRepository implements CategoryRepositoryInterface
{
    public $parent;
    private $time = 60 * 60 * 24 * 30;

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

    public function find($key): Category
    {
        return $this->parent->find($key);
    }

    public function create(array $input)
    {
        return $this->parent->create($input);
    }

    public function update(array $input, $key)
    {
        return $this->parent->update($input, $key);
    }

    public function delete($key)
    {
        return $this->parent->delete($key);
    }
}
