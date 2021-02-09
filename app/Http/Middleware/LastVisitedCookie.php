<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\MasterProduct;

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

        if ($product instanceof MasterProduct) {
            $product = $product->slug;
        }

        if ($lastVisited = $request->cookie('lastVisited')) {
            $recents = explode(',', $lastVisited);
            if (!in_array($product, $recents)) {
                if (count($recents) >= 8) {
                    array_shift($recents);
                }
                array_push($recents, $product);
            }
        } else {
            $recents = [$product];
        }

        $response = $next($request);

        $response->cookie('lastVisited', implode(',', $recents), 60 * 24 * 30);

        return $response;
    }
}
