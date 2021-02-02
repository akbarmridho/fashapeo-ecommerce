<?php

namespace App\Providers;

use App\Actions\Auth\Authenticate;
use App\Actions\Auth\CreateNewUser;
use App\Actions\Auth\ResetUserPassword;
use App\Actions\Auth\UpdateUserPassword;
use App\Actions\Auth\UpdateUserProfileInformation;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->isAdmin()) {
            config(['fortify.guard' => 'admin']);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::ignoreRoutes();

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::loginView(function () {
            if ($this->isAdmin()) {
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

        Fortify::authenticateUsing(new Authenticate);
    }

    private function isAdmin()
    {
        $uris = explode('/', $this->app->request->getRequestUri());

        if ($uris[1] === 'admin') {
            return true;
        }

        return false;
    }
}
