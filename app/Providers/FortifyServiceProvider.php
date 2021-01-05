<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route; 

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // if (request()->isAdmin()) {
        //     config(['fortify.domain' => adminUrl()]);
        //     config(['fortify.guard' => 'admin']);
        // }

        if (Route::currentRouteName('admin.*')) {
            config(['fortify.guard' => 'admin']);
        };
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::loginView(function () {
            if (Route::currentRouteName('admin.*')) {
                return view('auth.admin-login');
            }
            return view('auth.customer-login');
        });

        Fortify::registerView(fn () => view('auth.register'));
        
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        }); 

        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });
        
        Fortify::verifyEmailView(fn () => view('auth.verify-email'));
    }
}
