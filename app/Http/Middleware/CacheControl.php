<?php

namespace App\Http\Middleware;

use Closure;

class CacheControl
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

//        $response->header('Cache-Control', 'no-cache, must-revalidate');
        // Or whatever you want it to be:
//         $response->header('Cache-Control', 'max-age=86400');

        $expiry = now()->addMinutes(2880)->toRfc7231String();
        $response->header('Expires', $expiry);

        return $response;
    }
}
