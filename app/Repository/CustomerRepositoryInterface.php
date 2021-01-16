<?php
namespace App\Repository;

use App\Model\Customer;
use Illuminate\Support\Collection;

interface CustomerRepositoryInterface
{
   public function all(): Collection;

   // public function addresses
}