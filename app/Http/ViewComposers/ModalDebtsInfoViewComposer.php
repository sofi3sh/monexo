<?php

namespace App\Http\ViewComposers;

use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Transaction;
use App\Models\Home\UserMarketingPlan;
use Auth;
use Cache;
use DB;
use Illuminate\View\View;

/**
 * Connect Http Request class
 */
use Illuminate\Http\Request;

class ModalDebtsInfoViewComposer
{
    private $request;

    /**
     * Pass $request
     */
    public function __construct(Request $request)
    {
       $this->request = $request;
    }

    public function compose(View $view)
    {
        $user = Auth::user();
        $oldOpenPackages = null;
        $transactionStatistic = null;
        $oldBalance = null;

        // Cache::flush('showModalInfo');
        $showModalInfo = Cache::get('showModalInfo');
        
        // $showModalInfo = true;
        
        if($showModalInfo !== false) {
            
            $oldOpenPackages = UserMarketingPlan::
                where([
                    'user_id' => $user->id,
                    'end_at' => '2021-04-06 00:00:00',
                ])
                ->where('days_left', '>', 0)
                ->where('created_at', '<', '2021-04-06 00:00:00')
                ->get();

            $oldBalance = DB::table('balance_usd_values_06_04_2021')
                            ->where('user_id', $user->id)
                            ->pluck('balance_usd')[0] ?? null;
                            

            switch($showModalInfo) {
                case null: Cache::set('showModalInfo', true);
                break;
                case true: Cache::set('showModalInfo', false);
                break;
            }

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
        }

        $view->with([
            'oldOpenPackages' => $oldOpenPackages,
            'oldBalance'      => $oldBalance,
            'showModalInfo'   => $showModalInfo !== false,
            'transactionStatistic'   => $transactionStatistic
        ]);
    }
}
