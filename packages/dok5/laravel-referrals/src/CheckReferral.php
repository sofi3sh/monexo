<?php

namespace Dok5\Referrals;

use Closure;

class CheckReferral
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $keyName = config('referrals.referralCookieKey');
        $ref = $request->query(config('referrals.referralParamName'));
        // Если в параметрах запроса есть реферальная ссылка
        if ($ref) {
            // Запоминаем ее в куках.
            return redirect($request->Url())->withCookie(cookie()->forever($keyName, $ref));
        }

        return $next($request);
    }
}
