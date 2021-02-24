<?php

namespace App\Providers;

use App\Repository\CategoryRepositoryInterface;
use App\Repository\DeliveryRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Repository\StatusRepositoryInterface;
use App\Repository\Cache\CategoryRepository;
use App\Repository\Cache\ProductRepository;
use App\Repository\Cache\StatusRepository;
use App\Repository\Cache\RajaongkirRepository;
use App\Repository\Eloquent\OrderRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(StatusRepositoryInterface::class, StatusRepository::class);
        $this->app->bind(DeliveryRepositoryInterface::class, RajaongkirRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
