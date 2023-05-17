<?php


namespace App\Services\TelegramVerification\Traits;


use App\Services\PhoneVerification\Requests\AddPhoneRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

trait VerifiesTelegram
{
    use AuthenticatesUsers;

    /**
     * Show the phone verification notice.
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show()
    {
        if (auth()->user()->hasVerifiedTelegram()) {
            return redirect(route('home.main'));
        } else {
            return view('auth.verify-telegram');
        }
    }

    /**
     * Mark the authenticated user's phone number as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|RedirectResponse|Response|Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        if (!auth()->user()->telegram_id) {
            auth()->user()->update(['telegram_id' => $request->get('id')]);
            auth()->user()->save();
        }

        if (auth()->user()->telegram_id != $request->get('id')) {
            $this->logout($request);
            return redirect(route('login'));
        }

        auth()->user()->update(['telegram_verification_status' => true]);

        return redirect(route('home.main'));
    }

}
