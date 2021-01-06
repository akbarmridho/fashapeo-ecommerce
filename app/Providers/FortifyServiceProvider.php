<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;
use App\Models\Customer;
use App\Models\Admin;

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
        };
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
            if($this->isAdmin()) {
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

        Fortify::authenticateUsing(function (Request $request) {

            $customer = Customer::where('email', $request->email)->firstOr(function () {
                return false;
            });

            if ($customer &&
                Hash::check($request->password, $customer->password)) {
                return $customer;
            }

            $admin = Admin::where('email', $request->email)->firstOr(function () {
                return false;
            });

            if ($admin &&
                Hash::check($request->password, $admin->password)) {
                return $admin;
            }
    
        });

    }

    private function isAdmin() {
        $uris = explode('/', $this->app->request->getRequestUri());

        if($uris[1] === 'admin')  {
            return true;
        }

        return false;
    }
}
