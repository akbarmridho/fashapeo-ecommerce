<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LastVisitedCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $order = $request->route('product');

        if(! is_int($order)) {
            throw new \InvalidArgumentException('Parameter should be integer');
        }

        if(! $lastVisited = $request->cookie('lastVisited')) {
            $recents = explode(',', $lastVisited);
            if(count($recents) >= 8) {
                $recents = array_shift($recents);
            }
            $recents[] = $order;
        } else {
            $recents = [$order];
        }

        $response = $next($request);
        
        $response->cookie('lastVisited', implode(',', $recents), 60*24*30);

        return $response;
    }
}
