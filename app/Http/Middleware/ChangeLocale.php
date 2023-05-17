<?php

namespace App\Http\Middleware;

use Closure;

class ChangeLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        if ($locale && !session()->has('locale') && array_key_exists($locale, config('locale.languages'))) {
            session()->put('locale', $locale);
        }

        return $next($request);
    }
}
