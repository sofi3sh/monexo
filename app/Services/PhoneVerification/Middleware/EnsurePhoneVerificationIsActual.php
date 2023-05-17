<?php

namespace App\Services\PhoneVerification\Middleware;

use App\Services\PhoneVerification\Contracts\MustVerifyPhone;
use Closure;
use Illuminate\Support\Facades\Redirect;

class EnsurePhoneVerificationIsActual
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
        if (config('auth.phone_verification_code.enabled')) {
            if (! $request->user() || (
                    $request->user() instanceof MustVerifyPhone &&
                    ! $request->user()->hasActualVerification() &&
                    ! $request->user()->admin
                )) {
                return $request->expectsJson()
                    ? abort(403, 'Your phone number is not verified.')
                    : Redirect::route('verification.phone');
            }
        }

        return $next($request);
    }
}
