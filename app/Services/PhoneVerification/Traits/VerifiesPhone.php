<?php


namespace App\Services\PhoneVerification\Traits;


use App\Services\PhoneVerification\Requests\AddPhoneRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

trait VerifiesPhone
{
    /**
     * Show the phone verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show(Request $request)
    {
        if (empty($request->user()->phone)) {
            return redirect(route('register.add-phone-form'));
        }

        if ($request->user()->hasVerifiedPhone()) {
            return redirect(route('home.main'));
        } else {
            $request->user()->sendPhoneVerificationSms();
            return view('auth.verify-phone');
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
        $remember = (bool) $request->input('remember');
        $code = request()->input('code');

        if (auth()->user()->hasVerifiedPhone()) {
            return redirect(route('home.main'));
        }

        if (!auth()->user()->markPhoneAsVerified($remember, $code)) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['code' => __('auth.phone_verify.code_invalid')]);
        }

        return redirect(route('home.main'));
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedPhone()) {
            return redirect(route('home.main'));
        }

        $request->user()->sendPhoneVerificationSms(true);

        return back();
    }

    /**
     * Отображает форму для добавления профилю номера телефона
     *
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function addPhoneForm()
    {
        if (!empty(auth()->user()->phone)) {
            return redirect(route('home.main'));
        }

        return view('auth.add-phone');
    }

    /**
     * Устанавливает пользователю телефон и перенаправляет на страницу его подтверждения
     *
     * @param AddPhoneRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function addPhone(AddPhoneRequest $request)
    {
        auth()->user()->update(['phone' => request()->input('phone')]);
        return redirect(route('verification.phone'));
    }
}
