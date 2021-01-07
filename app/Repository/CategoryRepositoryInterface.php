<?php
namespace App\Repository;

use App\Model\Category;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
   public function all(): Collection;

   public function create(array $input, $creator): Category;

   public function update(array $input, $category, $creator): Category;
}