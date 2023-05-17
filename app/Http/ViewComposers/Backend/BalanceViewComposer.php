<?php

namespace App\Http\ViewComposers\Backend;


use Illuminate\Support\Facades\Auth;

class BalanceViewComposer
{
    public function compose($view)
    {
        $view->with('balance', Auth::user()->balance_usd);
    }
}