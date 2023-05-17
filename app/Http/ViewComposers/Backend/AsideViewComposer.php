<?php

namespace App\Http\ViewComposers\Backend;

use App\Models\Home\Alert;
use App\Models\Home\Ticket\TicketAnswer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AsideViewComposer
{
    public function compose($view)
    {
        $user = Auth::user();
        $balance = $user->balance_usd;
        $alerts_count = Alert::getCountNotViewed($user->id);

        $new_ticket_answer_count =  TicketAnswer::query()
            ->whereHas('ticket', function (Builder $query) use($user) {
                $query->where('user_id', $user->id);
            })
            ->where('viewed', '=', 0)
            ->where('user_id', '!=', $user->id)
            ->count(); // протестировано

        $view->with(compact('balance', 'alerts_count', 'new_ticket_answer_count'));
    }
}
