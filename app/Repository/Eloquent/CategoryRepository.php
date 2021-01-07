<?php

namespace App\Repository\Eloquent;

use App\Model\Category;
use App\Actions\CreateNewCategory;
use App\Actions\UpdateCategory;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Support\Collection;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

   /**
    * CategoryRepostiory constructor.
    *
    * @param Category $model
    */
   public function __construct(Category $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }

   /*
    * Create Category
    */
    public function create(array $input, CreateNewCategory $creator) {
       return $creator->create($input);
    }

   /*
    * Update category and its child and parent relationship
    */
    public function update(array $input, Category $category, UpdateCategory $creator) {
        return $creator->update($input, $category);
    }
}