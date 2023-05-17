<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\TelegramVerification\Traits\VerifiesTelegram;

class TelegramVerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Telegram Verification Controller
    |--------------------------------------------------------------------------
    */

    use VerifiesTelegram;

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
    }
}
