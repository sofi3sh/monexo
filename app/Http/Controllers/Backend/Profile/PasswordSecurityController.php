<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;
use App\Models\PasswordSecurity;
use Illuminate\Support\Facades\Hash;

class PasswordSecurityController extends Controller
{
    /**
     * This method returns the Form view to user from where he can enable or disable the 2FA.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show2faForm(Request $request)
    {
        $user = Auth::user();
        $google2fa_url = "";
        if ($user->passwordSecurity()->exists()) {
            $google2fa = new Google2FA();
            $google2fa_url = $google2fa->getQRCodeInline(
                '5Balloons 2A DEMO',
                $user->email,
                $user->passwordSecurity->google2fa_secret
            );
        }
        $data = array(
            'user'          => $user,
            'google2fa_url' => $google2fa_url
        );

        return view('backend.pages.profile.2fa')->with('data', $data);
    }

    public function generate2faSecret(Request $request)
    {
        $user = Auth::user();
        $google2fa = new Google2FA();

        // Add the secret key to the registration data
        PasswordSecurity::create([
            'user_id'          => $user->id,
            'google2fa_enable' => 0,
            'google2fa_secret' => $google2fa->generateSecretKey(),
        ]);

        return back()->with('success', "Секретный ключ сгенерирован, следуйте дальнейшим инструкциям.");
    }

    public function enable2fa(Request $request)
    {
        $user = Auth::user();
        $google2fa = new Google2FA();
        $secret = $request->input('verify-code');
        $valid = $google2fa->verifyKey($user->passwordSecurity->google2fa_secret, $secret);
        if ($valid) {
            $user->passwordSecurity->google2fa_enable = 1;
            $user->passwordSecurity->save();
            return back();
        } else {
            return back()->with('error', "Неверный код с приложения Google Authenticator.");
        }
    }

    public function disable2fa(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return back()->with("error", "Неверный пароль от Вашего аккаунта.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
        ]);
        $user = Auth::user();
        $user->passwordSecurity->google2fa_enable = 0;
        $user->passwordSecurity->save();
        return back()->with('success', "2FA отключена.");
    }
}
