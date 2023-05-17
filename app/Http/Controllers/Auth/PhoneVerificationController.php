<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\PhoneVerification\Traits\VerifiesPhone;

class PhoneVerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Phone Verification Controller
    |--------------------------------------------------------------------------
    */

    use VerifiesPhone;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
