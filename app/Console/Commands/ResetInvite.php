<?php

namespace App\Console\Commands;

use App\Models\Consts\AlertType;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Alert;
use App\Models\Home\ReferralDeposit;
use App\Models\Home\Transaction;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;
use Log;
use Mail;

class ResetInvite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ResetInvite:Run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отмена ивайтов через 48 часов';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            $referralDepositIds =  ReferralDeposit::on()
                ->where('is_accrued', 0)
                ->where('reset_invite_is', 0)
                ->where( 'created_at', '>', Carbon::now()->subDays(2))
                ->get()
                ->pluck('id')
                ->toArray();

            foreach ( $referralDepositIds as $referralDepositId ) {
                $referralDeposit = ReferralDeposit::on()
                    ->find( $referralDepositId )
                    ->first();

                $amountUSD = 0;
                $commissionAmount = 0;
                $cashBack = 0;
                if ( $referralDeposit->amount_usd > 0 ) {
                    $amountUSD = $referralDeposit->amount_usd;
                    $commissionAmount = $referralDeposit->amount_usd / 100 * $referralDeposit->commission_percent;
                    $cashBack = $amountUSD + $commissionAmount;
                }

                $currentBalance = (float) User::where( 'id', $referralDeposit->user_id )
                    ->pluck('balance_usd')
                    ->first();

                Alert::insert([
                    'user_id'           => $referralDeposit->user_id,
                    'email'             => $referralDeposit->referral_email,
                    'amount'            => $cashBack,
                    'alert_id'          => AlertType::INVITE_RESET_DEPOSIT,
                    'add_info'          => json_encode([
                        'ru' => 'Пользователь с email ' . $referralDeposit->referral_email . ' не воспользовался вашим инвайтом.',
                        'en' => 'The user with email ' . $referralDeposit->referral_email . ' did not use your invite.',
                    ]),
                    'currency_type'     => 'usd',
                    'marketing_plan_id' => null,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ]);

                Transaction::insert([
                    'user_id'                       => $referralDeposit->user_id,
                    'transaction_type_id'           => TransactionsTypesConsts::INVITE_RESET_DEPOSIT,
                    'amount_usd'                    => $amountUSD,
                    'commission'                    => $commissionAmount,
                    'balance_usd_after_transaction' => ($currentBalance + $cashBack),
                    'created_at'                    => Carbon::now(),
                    'updated_at'                    => Carbon::now(),
                ]);

                // Возвращаем деньги на баланс отправителя. Вся сумма: инвайт + комиссия.
                User::where('id', $referralDeposit->user_id)
                    ->update( ['balance_usd' => ($currentBalance + $cashBack)] );

                // 0 - ивайт не был отменен, 1 - его отменил крон
                ReferralDeposit::on()->where('id', $referralDeposit->id)
                    ->update( ['reset_invite_is' => 1] );
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Ошибка при отмене инвайтов: ' . $e->getMessage());
        }
//        Log::info('Success crontab');
    }
}
