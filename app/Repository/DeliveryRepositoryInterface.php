<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface DeliveryRepositoryInterface
{
    public function provinces(): Collection;

    public function cities($provinceId = null): Collection;

    public function cost(int $destination, int $origin, int $weight, string $courier): Collection;

    public function address(int $cityId): array;
}
