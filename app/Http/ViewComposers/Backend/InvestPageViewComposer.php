<?php

namespace App\Http\ViewComposers\Backend;

use App\Models\Home\Currency;
use App\Models\Consts\WalletsTypesConsts;
use App\Models\Home\Rate;
use App\Models\Home\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\Consts\TransactionsTypesConsts;

class InvestPageViewComposer
{
    public function compose($view)
    {
        $view->with([
            'user' => Auth::user(),
        ]);
    }
}