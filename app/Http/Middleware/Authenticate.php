<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (config('fortify.guard') == 'admin' && Auth::guest('admin')) {
                return route('admin.login');
            } elseif (Auth::guest('customer')) {
                return route('login');
            }

            return route('login');
        }
    }
}
