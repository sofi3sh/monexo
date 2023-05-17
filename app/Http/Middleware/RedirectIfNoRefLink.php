<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNoRefLink
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
        $parts = parse_url(url()->previous());
        if (isset($parts['query'])) {
            parse_str($parts['query'], $query);

            if (isset($query['ref'])) {
                 return redirect()->route('register');
             } 
        }
        //todo-tk Сделать проверку, что в куках есть реферальная ссылка и она валидна, только после этого пропускать запрос
        return $next($request);
    }
}
