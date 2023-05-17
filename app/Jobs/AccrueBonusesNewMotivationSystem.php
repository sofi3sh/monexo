<?php

namespace App\Jobs;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Transaction;
use Carbon\Carbon;

class AccrueBonusesNewMotivationSystem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * @var float
     */
    private $deposit_bonus_percent;

    /**
     * @var float
     */

    private $referrals_bonus_percent;

    /**
     * Количество месяцев, за которые производить начисления.
     * @var
     */
    private $month_count;

    /**
     * AccrueBonusesNewMotivationSystem constructor.
     *
     * @param User $user Пользователь, которому надо выполнить начисление бонусов по новой системе мотивации
     * @param float $deposit_bonus_percent Бонусный процент на сумму начисленных процентов по депозиту
     * @param float $referrals_bonus_percent Бонусный процент на сумму начисленных от рефералов
     */
    public function __construct(User $user, float $deposit_bonus_percent, float $referrals_bonus_percent, int $month_count)
    {
        $this->user = $user;
        $this->deposit_bonus_percent = $deposit_bonus_percent;
        $this->referrals_bonus_percent = $referrals_bonus_percent;
        $this->month_count = $month_count;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Вычисляем, суммы начисленные пользователю по депозиту и за рефералов
        $start_date = Carbon::parse($this->user->motivation_plan_start_at)->addMonths($this->month_count);
        $sumDepositAccruals = $this->user->sumDepositAccruals($start_date);
        $sumReferralsAccruals = $this->user->sumReferralsAccruals($start_date);

        // Определяем суммы бонусов по депозиту и за рефералов
        $sumDepositAccrualsBonuses = $sumDepositAccruals * ($this->deposit_bonus_percent / 100);
        $sumReferralsAccrualsBonuses = $sumReferralsAccruals * ($this->referrals_bonus_percent / 100);

        try {
            DB::beginTransaction();

            // Создаем транзакции бонусов по депозиту
            $transaction = new Transaction;
            $transaction->user_id = $this->user->id;
            $transaction->transaction_type_id = TransactionsTypesConsts::DEPOSIT_BONUSES_NEW_MOTIVATION_TYPE_ID;
            $transaction->amount_usd = $sumDepositAccrualsBonuses;
            $transaction->percent = $this->deposit_bonus_percent;
            $transaction->percent_on_amount = $sumDepositAccruals;
            $transaction->balance_usd_after_transaction = $this->user->balance_usd + $transaction->amount_usd;
            $transaction->save();

            // Создаем транзакции бонусов за рефералов
            $transaction = new Transaction;
            $transaction->user_id = $this->user->id;
            $transaction->transaction_type_id = TransactionsTypesConsts::REFERRALS_BONUSES_NEW_MOTIVATION_TYPE_ID;
            $transaction->amount_usd = $sumReferralsAccrualsBonuses;
            $transaction->percent = $this->deposit_bonus_percent;
            $transaction->percent_on_amount = $sumReferralsAccruals;
            $transaction->balance_usd_after_transaction = $this->user->balance_usd + $transaction->amount_usd;
            $transaction->save();

            Log::channel('actionlog')->info('Пользователю ' . $this->user->email . ' (id=' . $this->user->id .
                ') начислили за период с ' . $start_date . ' по ' . Carbon::now() .
                " на доход от депозита равный $$sumDepositAccruals проценты: " . $this->deposit_bonus_percent .
                "% и на доход от рефералов равный $$sumReferralsAccruals проценты: " . $this->referrals_bonus_percent . '%.' .
                " Что составляет: по депозиту $$sumDepositAccrualsBonuses, за рефералов: $$sumReferralsAccrualsBonuses, всего: $" .
                ($sumDepositAccrualsBonuses + $sumReferralsAccrualsBonuses) . ".");

            // Проверяем, есть ли еще запланированные начисления у пользователя.
            // Если нет - закрываем активный план.
            $job = Job::where('user_id', $this->user->id)
                ->where('queue', 'AccrueBonusesNewMotivationSystem')->get();
            // Если больше нет задач начислений (т.е. осталась одна выполняющаяся задача)
            if (count($job) == 1) {
                Log::channel('actionlog')->info('Пользователю ' . $this->user->email . '(id=' . $this->user->id . ') закрыли мотивационный план (id=' . $this->user->motivation_plan_id . ').');
                $this->user->motivation_plan_id = null;
                $this->user->motivation_plan_start_at = null;
                $this->user->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
        }
    }

}
