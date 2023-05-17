<?php

namespace App\Http\Controllers;

use App\Mail\NewsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send() {
        // Mail::to('eldar-dadashov@mail.ru')->send(new NewsMail());

        return Carbon::now()->toDateTimeString();
    }
}
