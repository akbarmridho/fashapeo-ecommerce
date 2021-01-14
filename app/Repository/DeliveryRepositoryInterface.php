<?php

namespace App\Repository;

interface DeliveryRepositoryInterface
{
    public function provinces();

    public function citites($provinceId = null);

    public function cost(int $destination, int $origin, int $weight, string $courier);

    public function address(int $cityId): array;
}