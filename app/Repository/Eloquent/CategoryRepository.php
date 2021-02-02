<?php

namespace App\Repository\Eloquent;

use App\Actions\Category\CreateNewCategory;
use App\Actions\Category\UpdateCategory;
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

    /*
     * Find category models by id
     */
    public function find($key): Category
    {
        return $this->category->find($key);
    }

    /*
     * Create Category
     */
    public function create(array $input)
    {
        return (new CreateNewCategory)->create($input);
    }

    /*
     * Update category and its child and parent relationship
     */
    public function update(array $input, $key)
    {
        return (new UpdateCategory)->update($input, $this->find($key));
    }

    /*
     * Create Category
     */
    public function delete($key)
    {
        $category = $this->find($key);

        if ($category->children->isNotEmpty()) {
            return false;
        }

        return $category->delete();
    }
}
