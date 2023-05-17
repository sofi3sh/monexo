<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Consts\AlertType;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\DebtsTransferSettings;
use App\Models\Home\Alert;
use App\Models\Home\Transaction;
use App\Models\Home\UserPaymentDetail;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Session;

class DinwayWalletDebtUsdController extends Controller
{
    public function withdrawal(Request $request) {
        
        $user = Auth::user();

        $settings = DebtsTransferSettings::find(1);
        $maxSumWithPercent = $user->debt_usd_fixed  * $settings->percent;
        $max = $user->debt_usd < $settings->min ? $user->debt_usd : $maxSumWithPercent;
        
        $validated = $request->validate([
            'amount_usd' => "numeric|min:0.01|max:$max"
        ]);

        if(!$user->verif_at) {
            Session::flash('error', 'У вас не верифицированный аккаунт');
        }

        

        DB::beginTransaction();
        try {
            
            $user->balance_usd += $validated['amount_usd'];
            $user->debt_usd -= $validated['amount_usd'];

            Transaction::create([
                'user_id'                       => $user->id,
                'transaction_type_id'           => TransactionsTypesConsts::DINWAY_WALLET_DEBT_USD_WITHDRAWAL,
                'amount_usd'                    => $validated['amount_usd'],
                'balance_usd_after_transaction' => $user->balance_usd,
                'created_at'                    => Carbon::now()
            ]);
            
            Alert::create([
                'user_id' => $user->id,
                'alert_id' => AlertType::DINWAY_WALLET_DEBT_USD_WITHDRAWAL,
                'amount' => $validated['amount_usd'],
                'currency_type' => 'usd',
            ]);

            UserPaymentDetail::create([
                'user_id' => $user->id,
                'currency_id' => 28,
                'address' => '',
                'additional_data' => 'debt_usd_to_balance_usd#' . $validated['amount_usd'] . ' #USD',
                'created_at' => Carbon::now(),
            ]);

            $user->save();
            DB::commit();
        }
        catch(\Exception $e) {
            Log::info($e->getMessage());
            DB::rollBack();
        }

        Session::flash('success', 'Вывод средств на основной счет прошел успешно');

        return redirect()->back();
    }
}
