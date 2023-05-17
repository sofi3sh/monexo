<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Http\Requests\Backend\Profile\ResetEmailRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\EmailResetMail;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

/**
 * Класс смены email
 *
 * Class EmailResetController
 * @package App\Http\Controllers\Backend
 */
class EmailResetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createToken()
    {
        $token = Str::random(32);
        Auth::user()->email_reset_token = $token;
        Auth::user()->save();

        return $token;
    }

    public function createLink($token)
    {
        return route('home.profile.email-reset', $token);
    }

    public function sendMail(ResetEmailRequest $request)
    {
        Auth::user()->new_email = $request->email;
        Auth::user()->save();

        try {
            Mail::to($request->email)
                ->send(new EmailResetMail(
                        $this->createLink(
                            $this->createToken()
                        )
                    )
                );
            Log::info('Отправили запрос на смену email ' . Auth::user()->email . ': ' . serialize($request->except('_token')));

            return back()->with('flash_success', trans('base_attention.email_reset.email_success', ['email' => $request->email]));
        } catch (Exception $ex) {
            Log::error($ex);

            return back()->with('flash_error', trans('base_attention.email_reset.email_error'));
        }
    }

    public function resetEmail(Request $request)
    {
        if (is_null($request->segment(4))) {
            abort(404);
        }

        $user = Auth::user()->where('email_reset_token', $request->segment(4))->firstOrFail();

        if ($user->email_reset_token == $request->segment(4)) {
            $user->email = $user->new_email;
            $user->new_email = null;
            $user->email_reset_token = null;
            $user->save();
            //

            return back()->with('flash_success', trans('base_attention.email_reset.email_update'));
        } else {
            echo(trans('base_attention.email_reset.email_not_update'));
            dd();
        }


        return redirect()->with('flash_success', trans('base_attention.email_reset.email_completed'))->route('home.profile.profile');
    }
}

