<?php

namespace App\Providers;

use App\Repository\CartRepositoryInterface;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\DeliveryRepositoryInterface;
use App\Repository\Eloquent\CartRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\OrderRepository;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\Eloquent\StatusRepository;
use App\Repository\Eloquent\WishlistRepository;
use App\Repository\OrderRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Repository\StatusRepositoryInterface;
use App\Repository\WishlistRepositoryInterface;
use App\Repository\Vendor\RajaongkirRepository;
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
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(WishlistRepositoryInterface::class, WishlistRepository::class);
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
