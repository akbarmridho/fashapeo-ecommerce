<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function active(): Collection;

    public function cancelled(): Collection;

    public function completed(): Collection;
}
