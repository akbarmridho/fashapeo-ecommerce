<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('admin', function () {
            return $this->isAdmin();
        });

        Paginator::defaultView('main.pagination.main');
        Paginator::defaultSimpleView('main.pagination.main');
    }

    private function isAdmin()
    {
        $uris = explode('/', $this->app->request->getRequestUri());

        if (!$uris || count($uris) <= 1) {
            return false;
        }

        if ($uris[1] === 'admin') {
            return true;
        }

        return false;
    }
}
