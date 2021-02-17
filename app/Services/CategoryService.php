<?php

namespace App\Services;

use App\Models\Category;
use App\Actions\Category\CreateNewCategory;
use App\Actions\Category\UpdateCategory;

class CategoryService
{
    private $creator;
    private $updater;

    public function __construct(CreateNewCategory $creator, UpdateCategory $updater)
    {
        $this->creator = $creator;
        $this->updater = $updater;
    }

    public function create(array $input)
    {
        return $this->creator->create($input);
    }

    public function update(array $input, Category $category)
    {
        return $this->updater->update($input, $category);
    }

    public function delete(Category $category)
    {
        if ($category->children->isNotEmpty()) {
            return false;
        }

        return $category->delete();
    }
}
