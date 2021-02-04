<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        $product = $request->route('product');

        if ($lastVisited = $request->cookie('lastVisited')) {
            $recents = array_map('intval', explode(',', $lastVisited));
            if (!in_array($product->id, $recents)) {
                if (count($recents) >= 8) {
                    array_shift($recents);
                }
                array_push($recents, $product->id);
            }
        } else {
            $recents = [$product->id];
        }

        $response = $next($request);

        $response->cookie('lastVisited', implode(',', $recents), 60 * 24 * 30);

        return $response;
    }
}
