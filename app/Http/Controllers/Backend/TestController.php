<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\MarketingPlan;
use App\Models\Home\ReferralDeposit;
use App\Models\Home\Transaction;
use App\Models\Home\UserMarketingPlan;
use App\Models\User;
use App\Models\VerifAnketAnswer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    public function index()
    {
        // $anket = VerifAnketAnswer::find(21);

        // dd($anket->photo);


//        $test = Transaction::on()
//            // "Пользовательский перевод (отправка)"
//            ->select('users.email', DB::raw('sum(transactions.amount_usd / 100 * transactions.commission) as profit'))
//            ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
//            ->where('transactions.transaction_type_id', TransactionsTypesConsts::USER_TRANSFER_SEND)
////            ->whereBetween('transactions.created_at', [$this->dateFrom, $this->dateTo])
//            ->groupBy('users.email')
//            ->orderBy('profit', 'desc')
//            ->limit(10)
//            ->get()
//            ->toArray();



//        return Transaction::on()
//            ->select('users.email', DB::raw('sum(transactions.commission) as transactions_commission'))
//            ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
//            // id типа транзкции "Вывод"
//            ->where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_TYPE_ID)
//            ->whereBetween('transactions.created_at', [$this->dateFrom, $this->dateTo])
//            ->groupBy('users.email')
//            ->orderBy('transactions_commission', 'desc')
//            ->limit(10)
//            ->get()
//            ->toArray();

//        $test = ReferralDeposit::on()
//            ->select(DB::raw('users.email, sum(referral_deposit.amount_usd / 100 * referral_deposit.commission_percent) as profit'))
//            ->leftJoin('users', 'referral_deposit.user_id', '=', 'users.id')
//            ->where('referral_deposit.is_accrued', 1)
//            ->where('referral_deposit.reset_invite_is', 0)
//            ->whereNotNull('users.email')
//            ->groupBy('referral_deposit.user_id')
//            ->orderBy('profit', 'desc')
//            ->limit(10)
//            ->get()
//            ->toArray();


//        return Transaction::on()
//            ->select('users.email', DB::raw('sum(transactions.amount_usd) as withdrawal_amount'))
//            ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
//            ->whereBetween('transactions.created_at', [$this->dateFrom, $this->dateTo])
//            // Заявка на вывод
//            ->where('transactions.transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID)
//            ->whereNotNull('users.email')
//            ->onlyTrashed()
//            ->groupBy('users.email')
//            ->orderBy('withdrawal_amount', 'asc')
//            ->limit(10)
//            ->get()
//            ->toArray();


        dd( $test );
    }
}
