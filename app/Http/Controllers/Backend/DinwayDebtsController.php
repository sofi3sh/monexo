<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Transaction;
use App\Models\Home\UserMarketingPlan;
use Auth;
use DB;

class DinwayDebtsController extends Controller
{
    public function index()
    { 
        $user = Auth::user();

        $oldOpenPackages = UserMarketingPlan::
            where([
                'user_id' => $user->id,
                'end_at' => '2021-04-06 00:00:00',
            ])
            ->where('days_left', '>', 0)
            ->where('created_at', '<', '2021-04-06 00:00:00')
            ->with('MarketingPlan')
            ->get();
            
            
        $oldBalance = DB::table('balance_usd_values_06_04_2021')
                        ->where('user_id', $user->id)
                        ->pluck('balance_usd')[0] ?? null;

        
        $transactionStatistic =  Transaction::where([
            'user_id' => $user->id
        ])
        ->whereIn('transaction_type_id', [
            // 1 - ввод INVEST_TYPE_ID = 1
            // 14 - вывод WITHDRAWAL_TYPE_ID
            TransactionsTypesConsts::INVEST_TYPE_ID,
            TransactionsTypesConsts::WITHDRAWAL_TYPE_ID
        ])
        ->get();
        

        $view = view('dashboard.dinway-debts');

        return $view->with([
            'oldOpenPackages'       => $oldOpenPackages,
            'oldBalance'            => $oldBalance,
            'transactionStatistic'  => $transactionStatistic
        ]);
    }
}
