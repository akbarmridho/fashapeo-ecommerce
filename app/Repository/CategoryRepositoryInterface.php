<?php

namespace App\Repository;

use App\Models\Category;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function all(): Collection;

    public function children(): Collection;

    public function parents(): Collection;
}
