<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OTPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('auth.google2faOtp');
    }

    public function check(Request $request)
    {
        $google2fa = app('pragmarx.google2fa');
        $secret = Auth::user()->twofa_secret;
        if ($google2fa->verify($request->input('otp'), $secret)) {
            session(["2fa_checked" => true]);
            return redirect("home");
        }

        throw ValidationException::withMessages([
            'otp' => 'Incorrect value. Please try again...'
        ]);
    }
}
