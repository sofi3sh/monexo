<?php

namespace App\Http\Controllers\Backend\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AdvertisingFeedback;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AdvertisingController extends Controller
{
    // Отправка почты с фидбэком
    public function feedback(Request $request)
    {
        $request->merge(['email' => Auth::user()->email]);
        $mail = trim(config('finance.payment_system_notifications_email'));
        try {
            Mail::to($mail)
                ->send(new AdvertisingFeedback($request));
            Log::info('Выполнен фидбэк со страницы рекламынх материлов от ' . Auth::user()->email);
        } catch (Exception $ex) {
            Log::error($ex);
        }
    }
}