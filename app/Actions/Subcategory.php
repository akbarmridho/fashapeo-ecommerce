<?php

namespace App\Actions;

use App\Models\Category;

trait Subcategory {

    public function setParent(Category $parentCategory, Category $childCategory) {

        $childCategory->associate($parentCategory);
        $this->setHasParent($childCategory);
        $this->unsetIsLastChild($parentCategory);

    }

    public function unsetParent(Category $parentCategory, Category $childCategory) {

        $childCategory->dissociate();
        $this->unsetHasParent($childCategory);
        $this->hasChild($parentCategory);

    }

    public function hasChild(Category $category) {

        $category->refresh();

        if($category->children->isEmpty()) {
            $this->setIsLastChild($category);
        }
    }

    public function setHasParent(Category $category) {
        $category->hasParent = true;
        $category->save();
    }

    public function unsetHasParent(Category $category) {
        $category->hasParent = false;
        $category->save();
    }

    public function setIsLastChild(Category $category) {
        $category->isLastChild = true;
        $category->save();
    }

    public function unsetIsLastChild(Category $category) {
        $category->isLastChild = false;
        $category->save();
    }
}