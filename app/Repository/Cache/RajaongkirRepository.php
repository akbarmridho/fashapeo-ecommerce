<?php

namespace App\Repository\Cache;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use App\Repository\DeliveryRepositoryInterface;
use App\Repository\Vendor\RajaongkirRepository as VendorRepository;

class RajaongkirRepository implements DeliveryRepositoryInterface
{
    private $parent;
    private $time = 60 * 60;

    public function __construct(VendorRepository $parent)
    {
        $this->parent = $parent;
    }

    public function provinces(): Collection
    {
        return Cache::tags(['rajaongkir'])->remember('rj.provinces', $this->time, function () {
            return $this->parent->provinces();
        });
    }

    public function cities($provinceId = null): Collection
    {
        return Cache::tags(['rajaongkir'])->remember('rj.city' . $provinceId ? `.$provinceId` : '', $this->time, function () use ($provinceId) {
            return $this->parent->cities($provinceId);
        });
    }

    public function cost(int $destination, int $origin, int $weight, string $courier): Collection
    {
        return Cache::tags(['rajaongkir'])->remember('rj.cost:from' . $origin . ',to' . $destination, $this->time, function () use ($destination, $origin, $weight, $courier) {
            return $this->parent->cost($destination, $origin, $weight, $courier);
        });
    }
}
