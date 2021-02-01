<?php

namespace App\Providers;

use App\View\Composers\CategoryComposer;
use App\View\Composers\CustomerComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(
            [
                'main.pages.*',
                'customer.pages.*'
            ],
            CategoryComposer::class
        );
        View::composer(['customer.pages.*'], CustomerComposer::class);
    }
}
