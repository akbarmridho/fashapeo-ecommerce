<?php

namespace App\Repository\Eloquent;

use App\Models\Category;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public $category;

    /**
     * CategoryRepostiory constructor.
     *
     * @param Category $model
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->category->all();
    }

    public function children(): Collection
    {
        return $this->category->children()->get();
    }

    public function parents(): Collection
    {
        return $this->category->parents()->withChildren()->get();
    }
}
