<?php

namespace App\Repository\Eloquent;

use App\Model\Customer;
use App\Repository\CustomerRepositoryInterface;
use Illuminate\Support\Collection;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{

   /**
    * CustomerRepository constructor.
    *
    * @param Customer $model
    */
   public function __construct(Customer $model)
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
}