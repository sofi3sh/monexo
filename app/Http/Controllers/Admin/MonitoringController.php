<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MonitoringController extends Controller
{
    public function showMainPage(Request $request)
    {
        // Если GET-запрос
        if ($request->method() == 'GET') {
            // Если не заданы параметры в запросе, устанавливаем период дат - за сегодня
            if (count($request->toArray()) == 0) {
                $start = Carbon::now()->toDateString();
                $end = Carbon::now()->toDateString();

            } else { // Если заданы даты - присваиваем их переменным
                $start = $request->start;
                $end = $request->end;
            }
        }

        // Общая прибыль
        $profit = Transaction::realAndNotDeletedUsers($start, $end, [TransactionsTypesConsts::INVEST_TYPE_ID, TransactionsTypesConsts::WITHDRAWAL_TYPE_ID])
            ->sum(DB::raw('amount_usd'));
        // Инвестиции
        $qry = Transaction::realAndNotDeletedUsers($start, $end, [TransactionsTypesConsts::INVEST_TYPE_ID]);
        $invested = $qry->sum(DB::raw('amount_usd'));
        $invested_transactions = $qry->get();
        // Выводы
        $qry = Transaction::realAndNotDeletedUsers($start, $end, [TransactionsTypesConsts::WITHDRAWAL_TYPE_ID]);
        $withdrawal = $qry->sum(DB::raw('amount_usd*(100-commission)/100')); // (добавить учет комиссии)
        $withdrawal_transactions = $qry->get();
        // Кол-во зарегистрированных пользователей
        $reg_count = DB::select('SELECT count(invested_usd) as s FROM `users` where fake=0 and date(created_at)>=? and date(created_at)<=? and deleted_at is null', [$start, $end]);
        $reg_users = DB::select('SELECT * FROM `users` where fake=0 and date(created_at)>=? and date(created_at)<=? and deleted_at is null', [$start, $end]);

        return view('monitoring.main')->with([
            'profit'                  => $profit,
            'invested'                => $invested,
            'invested_transactions'   => $invested_transactions,
            'withdrawals'             => -$withdrawal,
            'withdrawal_transactions' => $withdrawal_transactions,
            'reg_count'               => $reg_count[0]->s,
            'reg_users'               => $reg_users,
            'start'                   => $start,
            'end'                     => $end,
        ]);
    }

}
