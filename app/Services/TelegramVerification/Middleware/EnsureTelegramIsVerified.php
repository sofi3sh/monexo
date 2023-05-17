<?php

namespace App\Services\TelegramVerification\Middleware;

use App\Services\TelegramVerification\Contracts\MustVerifyTelegram;
use Closure;
use Illuminate\Support\Facades\Redirect;

class EnsureTelegramIsVerified
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
        if (env('TG_BOT_TOKEN')) {
            if (! $request->user() || (
                    $request->user()->telegram_verification_required &&
                    ! $request->user()->telegram_verification_status &&
                    ! $request->user()->admin
                )) {
                return $request->expectsJson()
                    ? abort(403, 'Your telegram is not verified.')
                    : Redirect::route('verification.telegram');
            }
        }

        return $next($request);
    }
}
