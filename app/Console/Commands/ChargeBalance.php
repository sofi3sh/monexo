<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Home\Transaction;
use App\Models\Consts\TransactionsTypesConsts;
use Illuminate\Support\Facades\DB;
use App\Models\Home\UserPaymentDetail;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Home\Alert;
use App\Models\Consts\AlertType;

class ChargeBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'charge:balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Начислять балансы пользователей';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::where('balance_usd', '>', 0)->get();
        foreach ($users as $user) {
            $date       = Carbon::now()->subDays(1)->format('Y-m-d H:i:s');
            $sumDesosit = $user->sumDepositLast($date);

            $balance = $user->balance_usd-$sumDesosit;
            $percent = $balance*0.0025;
            $total   = $balance+$percent+$sumDesosit;

            DB::beginTransaction();
            try{
                $transaction                                = new Transaction;
                $transaction->user_id                       = $user->id;
                $transaction->transaction_type_id           = TransactionsTypesConsts::DEPOSIT_PROCENT;
                $transaction->amount_usd                    = $percent;
                $transaction->balance_usd_after_transaction = $total;
                $transaction->save();

                $payout                  = new UserPaymentDetail();
                $payout->currency_id     = 23;
                $payout->user_id         = $user->id;
                $payout->address         = 'success';
                $payout->transaction_id  = $transaction->id;
                $payout->additional_data = "Deposit percent#".$percent.'#USD';
                $payout->save();

                $alert              = new Alert;
                $alert->user_id     = $user->id;
                $alert->alert_id    = AlertType::DEPOSIT_PROCENT;
                $alert->amount      = $percent;
                $alert->currency_id = 23;
                $alert->save();

                $user->update(['balance_usd' => $total]);

                DB::commit();

            }catch(\Exception $e) {
                DB::rollback();
            }
        }
    }
}
