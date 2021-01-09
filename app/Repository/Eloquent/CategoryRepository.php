<?php

namespace App\Repository\Eloquent;

use App\Models\Category;
use App\Actions\CreateNewCategory;
use App\Actions\UpdateCategory;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Support\Collection;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public $creator;
    public $handler;

   /**
    * CategoryRepostiory constructor.
    *
    * @param Category $model
    */
   public function __construct(Category $model, CreateNewCategory $creator, UpdateCategory $handler)
   {
       parent::__construct($model);
       $this->creator = $creator;
       $this->handler = $handler;
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }

   public function children(): Collection
   {
       return $this->model->children()->get();
   }

   public function parents(): Collection
   {
       return $this->model->parents()->get();
   }

   /*
    * Find category models by id
    */
    public function find($key): Category
    {
        return $this->model->find($key);
    }

   /*
    * Create Category
    */
    public function create(array $input) 
    {
       return $this->creator->create($input);
    }

   /*
    * Update category and its child and parent relationship
    */
    public function update(array $input, $key) 
    {
        return $this->handler->update($input, $this->find($key));
    }

   /*
    * Create Category
    */
    public function delete($key)
    {

        $category = $this->find($key);

        if($category->children->isNotEmpty())
        {
            return false;
        }

        return $category->delete();
    }
    
}