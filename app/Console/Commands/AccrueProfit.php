<?php

namespace App\Console\Commands;

use App\Models\Admin\ReferralAccrualParam;
use App\Models\Consts\AlertType;
use App\Models\Consts\BalanceTypeConstants;
use App\Models\Consts\CurrencyConstants;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Alert;
use App\Models\Home\Balance;
use App\Models\Home\MarketingPlan;
use App\Models\Home\OutgoingPayments;
use App\Models\Home\Transaction;
use App\Models\Home\UserMarketingPlan;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class AccrueProfit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AccrueProfit:Run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Выполнить начисления прибыли по депозиту';

    protected $accrue_log;

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
     * Выполнение ежедневных начислений.
     *
     * @return mixed
     */
    public function handle()
    {
        // return; // TODO remove.
        // Запоминаем, когда начали
        $start = date('Y-m-d H:i:s');
        $this->info('Start ' . $start);
        Log:info("Запуск every 1 minutes $start !");
        DB::beginTransaction();
        try {
            $this->accrue_log = new Logger('accrues');
            $this->accrue_log->pushHandler(new StreamHandler(storage_path('logs/accrues_' . date("m-d-y") . '.log')), Logger::INFO);
            // Определяем месячные проценты по всем планам для последующего начисления [plan_id, rand_percent]
            $percents = $this->getAccruedPercents();
            // Получаем список пользователей с их уровнем в иерархии (поле depth)
            User::whereHas('userAllMarketingPlans', function ($query) {
                    $query->whereNull('deleted_at')
                        ->whereNull('end_at')
                        ->where(function ($query) {
                            $query->where('invested_usd', '>', '0')
                                ->orWhere('marketing_plan_id', MarketingPlan::MP_BTC_INVITATION)
                                ->orWhere('marketing_plan_id', MarketingPlan::MP_PZM_INVITATION)
                                ->orWhere('marketing_plan_id', MarketingPlan::MP_ETH_INVITATION)
                                ->orWhere('marketing_plan_id', MarketingPlan::MP_USD_INVITATION);
                        });
                })
                ->with(['userMarketingPlan', 'marketingPlan'])
                ->withDepth()
                ->chunk(100, function ($users) use ($percents) {

    $users->each(function ($user) use ($percents) {
        /** @var User $user */

    // Сбрасываем сохраненную сумму последней прибыли по маркетинг-плану
    // Коммент от другого разработчика, не знаю что имел ввиду предыдущий,
    // но тут явно идет начисление матчинг бонуса, который решили выпилить
    if ($user->getMatchingBonusPercent() > 0) {
        $percentmatchingBonus = floatval($user->getMatchingBonusPercent());
        $matchingBonus = 0;

        // @var UserMarketingPlan[] $marketingPlanPartners
        $marketingPlanPartners = UserMarketingPlan::whereIn('user_id', $user->refferrals->pluck('id'))->whereNull('deleted_at')
                                ->whereNull('end_at')
                                ->get();

        foreach ($marketingPlanPartners as $value) {
            if (
                $value->marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_BUSINESS) //||
                //$value->marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_CRYPTO_BUSINESS) ||
                //$value->marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_LIGHT) ||
                //$value->marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_NEW_LIGHT)
            ) {
                $maxDurationDays = $value->marketingPlan->max_duration;
                $daysDiff = $maxDurationDays - $value->days_left;
                if ($value->days_left === $maxDurationDays || $daysDiff % 7 !== 0 || $value->isStopped()) {
                    continue;
                }
            }

            if ($value->invested_pzm > 0) {
                $daily_profit   = ($value->invested_pzm*$value->marketingPlan->daily_percent)/100;
                $matchingBonus += (($daily_profit*$percentmatchingBonus)/100)*$value->rate;
            }else if($value->invested_btc > 0){
                $daily_profit   = ($value->invested_btc*$value->marketingPlan->daily_percent)/100;
                $matchingBonus += (($daily_profit*$percentmatchingBonus)/100)*$value->rate;
            }else if($value->invested_eth > 0){
                $daily_profit   = ($value->invested_eth*$value->marketingPlan->daily_percent)/100;
                $matchingBonus += (($daily_profit*$percentmatchingBonus)/100)*$value->rate;
            }else {
                $dailyPercent = $value->marketingPlan->daily_percent;
                 //для пакетов у которых процент случайный — значение daily_percent 0,
                 //поэтому получаем его из сгенерированного массива
                if (!$dailyPercent || $dailyPercent <= 0) {
                    if (isset($percents[$value->marketing_plan_id]) && $percents[$value->marketing_plan_id] > 0) {
                        $dailyPercent = $percents[$value->marketing_plan_id];
                        $this->info($value->user_id . ' - ' . $value->marketing_plan_id . ' - ' . $dailyPercent);
                    }
                }
                $daily_profit   = ($value->invested_usd*$dailyPercent)/100;
                $matchingBonus += ($daily_profit*$percentmatchingBonus)/100;
            }
        }
        if ($matchingBonus > 0) {
            $transaction                                = new Transaction();
            $transaction->user_id                       = $user->id;
            $transaction->transaction_type_id           = TransactionsTypesConsts::MATCHING_BONUS;
            $transaction->amount_usd                    = $matchingBonus;
            $transaction->balance_usd_after_transaction = $user->balance_usd + $matchingBonus;
            $transaction->save();

            $alert           = new Alert;
            $alert->user_id  = $user->id;
            $alert->alert_id = AlertType::MATCHING_BONUS;
            $alert->amount   = $matchingBonus;
            $alert->save();

            $user->balance_usd += $matchingBonus;
            $user->bonuses_usd += $matchingBonus;

            $user->save();
        }

    }


    $user->last_marketing_plan_profit = 0;
    $this->accrue_log->info('------------------------------------------- ');
    $this->accrue_log->info($user->email . ' ------------ Начисляем пользователю ------- ');
    // Получаем все маркетинговые планы пользователя
    $userMarketingPlans = $user->userMarketingPlans;

    // Если у пользователя есть маркетинговый план
    if (!is_null($userMarketingPlans)) {

        foreach($userMarketingPlans as $userMarketingPlan) {
            /** @var UserMarketingPlan $userMarketingPlan */

            /** @var Carbon $userMarketingPlanDate */
            $userMarketingPlanDate = $userMarketingPlan->getAttribute('updated_at');

            $skipDates = [
                date('Y-m-d'),
                date('Y-m-d', strtotime('yesterday'))
            ];

            // если пользователь купил пакет вчера или сегодня (00:01),
            // то этот пакет не учитывается и пропускается
            //if (in_array($userMarketingPlanDate->toDate()->format('Y-m-d'), $skipDates)) {
            if ( $userMarketingPlanDate->toDate()->format('Y-m-d') >= date('Y-m-d') ) {
                continue;
            }

            if ($userMarketingPlan->marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_MINI)) {
                if ($userMarketingPlan->created_at->diffInHours(now()) <= 48) {
                    continue;
                }

                if (now()->isWeekend()) {
                    continue;
                }
            }

            // Получаем маркетинг план (по таблице-справочнику)
            // Если start_at == null поставить текущую дату и перейти к следующему плану
            if(is_null($userMarketingPlan->start_at)){
                $userMarketingPlan->start_at = Carbon::now();
                $userMarketingPlan->save();
            }else{
                $marketingPlan = $userMarketingPlan->marketingPlan;

                // Создаем транзакцию начисления по депозиту
                $profit = $this->createProfitTransaction($user, $userMarketingPlan, $marketingPlan, $percents);

                // Сохраняем, чтобы потом менее затратно рассчитать доходность по линии
                $user->last_marketing_plan_profit += $profit;
                // Если в инвест плане $userMarketingPlan->days_left == 0 закрываем план
                if($userMarketingPlan->days_left == 0){
                    $this->closePlan($user, $userMarketingPlan);
//                    $userMarketingPlan->end_at = now();
//                    $i = $userMarketingPlan->balance_usd - $userMarketingPlan->invested_usd;
//                    if(($i - $userMarketingPlan->profit_usd)>0){
//                        $user->profit_usd += ($i - $userMarketingPlan->profit_usd);
//                        $user->save();
//                        $userMarketingPlan->profit_usd = $i;
//                    }
//                    $userMarketingPlan->save();
                    $this->accrue_log->info("     Закрываем план.");
                }

                // якщо пакет == Random, закрити план при досягненні прибутку 180%
                if ($marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_MINI)) {
                    if ($userMarketingPlan->profit_usd >= $userMarketingPlan->invested_usd * 0.1) {
                        $this->closePlan($user, $userMarketingPlan);

                        $this->accrue_log->info("     Закрываем план.");
                    }
                }

                $userMarketingPlan->save();
            }
        }
    } else {
            $this->accrue_log->info('У пользователя нет маркетингово плана.');
            }
    $user->save();
});
            });

            // Создаем транзакции начислений за реферальных пользователей
//            $this->createProfitReferralsTransactions();

            // Удаляем накопившиеся id оплат
            $this->deleteOldOutgoingPayments();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $this->info($e->getMessage());
        }
        $end = date('Y-m-d H:i:s');
        $this->info('End   ' . $end);
    }

    /**
     * Закрывает активный план.
     *
     * @param User $user
     * @param UserMarketingPlan $userMarketingPlan
     */
    public function closePlan(User $user, UserMarketingPlan $userMarketingPlan)
    {
        $marketing_plan = $userMarketingPlan->marketingPlan;
        $codeBalans = 'balance_' . $marketing_plan->currency_type;
        $codeAmount = 'amount_' . $marketing_plan->currency_type;
        $codeInvested = 'invested_' . $marketing_plan->currency_type;
        $code_balance_after_transaction = 'balance_' . $marketing_plan->currency_type . '_after_transaction';

        // Создаем транзакцию перевода тела с маркетингового плана на основной счет.
        // В TransactionObserver баланс пользователя увеличится на amount_usd созданной транзакции.
        $transaction = new Transaction();
        $transaction->user_id = $userMarketingPlan->user_id;
        $transaction->transaction_type_id = TransactionsTypesConsts::TRANSFER_BODY_FROM_MARKETING_PLAN_TO_MAIN_BALANCE;
        $transaction->$codeAmount = $userMarketingPlan->$codeInvested;
        $transaction->$code_balance_after_transaction = $user->$codeBalans + $userMarketingPlan->$codeInvested;
        $transaction->save();

        // Сумму, инвестированную в коин не переводим, поскольку она начисляется на отдельный счет инвестиций в коин.

        // Закрываем маркетинговый план у пользователя
        $userMarketingPlan->end_at = now();
        $userMarketingPlan->save();

        $amount = $userMarketingPlan->$codeInvested;


        if ($userMarketingPlan->marketing_plan_id == 24) {
            $commission = ($userMarketingPlan->$codeInvested * $userMarketingPlan->marketingPlan->withdrawal_commission) / 100;
            $amount     = $userMarketingPlan->$codeInvested - $commission;
            $user->$codeBalans += $amount;
            $user->save();
        }

//        if ( MarketingPlan::MP_USD_INVITATION != $userMarketingPlan->marketing_plan_id ) {
//
//        }

        $alert                    = new Alert;
        $alert->user_id           = $user->id;
        $alert->alert_id          = AlertType::CLOSE_INVESTMENT;
        $alert->amount            = $amount;
        $alert->marketing_plan_id = $userMarketingPlan->marketing_plan_id;
        $alert->currency_type     = $userMarketingPlan->marketingPlan->currency_type;
        $alert->save();

        $this->accrue_log->info("     Закрываем план.");
    }

    /**
     * Возвращает True, если текущее начисление последнее, т.е. надо закрывать план.
     *
     * @param MarketingPlan $marketingPlan
     * @param UserMarketingPlan $userMarketingPlan
     * @return
     */
    public function isLastAccrue(MarketingPlan $marketingPlan, UserMarketingPlan $userMarketingPlan)
    {
        $from = Carbon::parse($userMarketingPlan->start_at);

        // Начало     17-11-2019 18:30:00
        // Начисления 18-11-2019 18:30:01
        // Carbon::now()->diffInDays($from) возвращает 1.
        //
        // Начало     15-11-2019 18:30:00
        // Начисления 18-11-2019 18:30:01
        // Carbon::now()->diffInDays($from) возвращает 3.

        return Carbon::now()->diffInDays($from) >= $marketingPlan->max_duration;
    }

    /**
     * Возвращает месячные проценты по всем планам для последующего начисления.
     *
     * @return array
     */
    public function getAccruedPercents()
    {
        $accruedPercents = [];
        $minPercent = 0;
        $maxPercent = 0;

        foreach ( MarketingPlan::all() as $marketingPlan ) {

            if ( ! is_null( $marketingPlan->manual_percent ) ) {

                $couple = explode(':', $marketingPlan->manual_percent);
                if ( count( $couple ) === 2 ) {
                    $minPercent = $couple[0];
                    $maxPercent = $couple[1];
                }
            } else {
                $minPercent = $marketingPlan->min_profit;
                $maxPercent =$marketingPlan->max_profit;
            }

            $accruedPercents[ $marketingPlan->id ] = mt_rand( $minPercent * 100, $maxPercent * 100 ) / 100;
        }
        return $accruedPercents;
    }

    /**
     * Возвращает месячные проценты по всем планам для последующего начисления
     *
     * @return array
     */
//    public function getAccruedPercents()
//    {
//        $res = [];
//        foreach (MarketingPlan::all() as $plan) {
//            if ($plan->manual_percent && strstr($plan->manual_percent, ':')) {
//                $percent = explode(':', $plan->manual_percent);
//                $plan->min_profit = (float)$percent[0];
//                $plan->max_profit = (float)$percent[1];
//                $plan->manual_percent = null;
//            }
//            $res[$plan->id] = $plan->manual_percent ?? $this->getRandomBetween($plan->min_profit, $plan->max_profit);
//        }
//
//        $this->accrue_log->info("Используем проценты для начислений: " . serialize($res));
//
//        return $res;
//    }


    /**
     * Возвращает случайный процент из заданного диапазона.
     *
     * @param float $min
     * @param float $max
     * @return float
     */
    public function getRandomBetween(float $min, float $max): float
    {
        return mt_rand($min * 100, $max * 100) / 100;
    }

    /**
     * Возвращает дневной процент начислений.
     *
     * @param float $month_percent
     * @return float
     */
    public function dailyPercent(float $month_percent): float
    {
        return round($month_percent / config('finance.number_accruals_during_month'), 2);
    }

    /**
     * Возвращает True, если текущий день - рабочий
     *
     * @return mixed
     */
    public function isNowWeekday()
    {
        return Carbon::now()->isWeekday();
    }

    /**
     * Возвращает True, если пользователю необходимо выполнять начисления в текущий день согласно его маркетингового плана
     *
     * @param User $user
     * @return bool
     */
    public function isNeedToAccrueInViewOfWeekdayOrWeekend(User $user): bool
    {
        return true;
//        return $user->marketingPlan()->first()->only_business_days
//            ? $this->isNowWeekday()
//            : true;
    }

    /**
     * Возвращает True, если пользователю надо начислять простой процент, false — если сложный.
     *
     * @param MarketingPlan $marketingPlan
     * @param UserMarketingPlan $userMarketingPlan
     * @return bool
     */
    public function isAccrualSimplePercent(MarketingPlan $marketingPlan, UserMarketingPlan $userMarketingPlan): bool
    {
        $from = Carbon::parse($userMarketingPlan->start_at);
        $to = Carbon::now();
        $diffInDays = $this->diffInDays($from, $to, (bool)$marketingPlan->only_business_days);

        /*dd('простой процент? ' . json_encode(($diffInDays <= $marketingPlan->first_days_count_for_simple_percent)),
            'начало плана    ' . $from,
            'до              ' . $to,
            'только рабочие? ' . json_encode($marketingPlan->only_business_days),
            'кол-во дней:    ' . $diffInDays,
            'по плану:       '. $marketingPlan->first_days_count_for_simple_percent);*/

        return $diffInDays <= $marketingPlan->first_days_count_for_simple_percent;
    }

    /**
     * Возвращает кол-во дней между диапазоном дат
     *
     * @param $from - Начиная с даты
     * @param bool $onlyBusinessDays - Количество только рабочих дней
     * @param $to - Конец периода
     * @return int
     */
    public function diffInDays($from, $to, $onlyBusinessDays): int
    {
        if ($onlyBusinessDays) {
            $cnt = $from->diffInDaysFiltered(function (Carbon $date) {
                return !$date->isWeekend();
            }, $to);
            return $cnt - 1;
        } else {
            return $diffInDays = $to->diffInDays($from);
        }
    }

    /**
     * Создаем транзакцию с начислением прибыли.
     *
     * @param User $user
     * @param UserMarketingPlan $userMarketingPlan
     * @param MarketingPlan $marketingPlan
     * @param array $percents - Случайные месячные проценты по всем планам для последующего начисления [plan_id, rand_percent]
     * @return float
     */
    public function createProfitTransaction(User $user, UserMarketingPlan $userMarketingPlan, MarketingPlan $marketingPlan, array $percents): float
    {
        // Получаем процент, который необходимо начислить согласно плана пользователя
        /*$percent = $percents[$userMarketingPlan->marketing_plan_id];
        // Получаем сумму, на которую необходимо выполнять начисления
        //$amountUsd = $this->getAccrueAmount($user, $marketingPlan, $userMarketingPlan);
        $amountUsd = $userMarketingPlan->invested_usd;
        // Определяем, какой % отчисляем на коин
        $coinPercent = $marketingPlan->coin_percent;
        // Рассчитываем прибыль (без учета отчислений на коин)
        $profitUsd = $amountUsd / 100 * $percent;
        // Сумма usd, которая начисляется на баланс коина
        $profiTtoCoinBalance = $profitUsd / 100 * $coinPercent;
        // Прибыль минус отчисления на коин
        $profitUsdClear = $profitUsd - $profiTtoCoinBalance;
        // Тело инвестиции за 1 день
        $bodyUsd = $amountUsd / $marketingPlan->min_duration;*/

        $code = $marketingPlan->currency_type;

        $codeAmount = 'amount_'.$code;
        $codeProfit = 'profit_'.$code;
        $codeBalans = 'balance_'.$code;
        $codeInvested = 'invested_'.$code;
        $code_balance_after_transaction = 'balance_'.$code.'_after_transaction';

        // - определение процента, который будет начисляться
        // - обработка способа начисления
        if (
            $marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_BUSINESS) ||
            $marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_CRYPTO_BUSINESS) ||
            $marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_LIGHT) ||
            $marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_NEW_LIGHT)
        ) {

            $maxDurationDays = $userMarketingPlan->marketingPlan->max_duration;
            $daysDiff = $maxDurationDays - $userMarketingPlan->days_left;
            if ($userMarketingPlan->days_left === $maxDurationDays || $daysDiff % 7 !== 0 || $userMarketingPlan->isStopped()) {
                $userMarketingPlan->days_left = $userMarketingPlan->days_left - 1;
                $userMarketingPlan->save();
                return true;
            }
            $percent = $percents[$marketingPlan->id];

            $amountUsd = $userMarketingPlan->$codeInvested + $userMarketingPlan->$codeProfit;
        } elseif ($marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_MINI)) {
            $percent = $percents[$marketingPlan->id];
            $amountUsd = $userMarketingPlan->$codeInvested;
        } else {
            $percent = $marketingPlan->daily_percent;
            $amountUsd = $userMarketingPlan->$codeInvested;
        }

        $coinPercent = $marketingPlan->coin_percent;

        $profitUsd = $amountUsd / 100 * $percent;


        $profiTtoCoinBalance = $profitUsd / 100 * $coinPercent;

        $profitUsdClear = $profitUsd - $profiTtoCoinBalance;

        //$bodyUsd = $amountUsd / $marketingPlan->min_duration;

        //
        $this->accrue_log->info("     marketing_plan_id=$marketingPlan->id, user_marketing_plan_id=$userMarketingPlan->id, процент начисления: $percent% на сумму: $$amountUsd. Прибыль без отчислений на коин: $$profitUsd, отчисления на коин — $coinPercent%, что равно $$profiTtoCoinBalance, начислено $$profitUsdClear.");

        // По модулю берем, поскольку может быть и "-"
        if (abs($profitUsdClear) < 0.01 && $code == 'usd') {
            $this->accrue_log->info("Не начисляем - маленькая сумма ($$profitUsdClear)");
            return true;
        }


            // Создаем транзакцию - прибыль от инвест. в маркетинговый план
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->transaction_type_id = TransactionsTypesConsts::PROFIT_TYPE_ID;
            $transaction->$codeAmount = $profitUsdClear;
            if ($code != 'usd') {
                $transaction->amount_crypto = $profitUsdClear*$userMarketingPlan->rate;
            }
            $user->$codeProfit += $profitUsd;
            $user->save();

            $transaction->$code_balance_after_transaction = $userMarketingPlan->$codeBalans + $profitUsdClear;
            if (
                $marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_BUSINESS) ||
                $marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_CRYPTO_BUSINESS) ||
                ($marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_LIGHT) && !$userMarketingPlan->isStopped()) ||
                ($marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_NEW_LIGHT) && !$userMarketingPlan->isStopped())
            ) {
                // пользователь выводит самостоятельно прибыль
            } else {
                $transaction->save();
            }

            // Изменяем балансы текущего маркетинг-плана
            $userMarketingPlan->coin_usd += $profiTtoCoinBalance;
            $userMarketingPlan->$codeBalans += $profitUsdClear;
            $userMarketingPlan->$codeProfit += $profitUsd;
            $userMarketingPlan->days_left = $userMarketingPlan->days_left - 1;
            $userMarketingPlan->save();

            $alert                    = new Alert;
            $alert->user_id           = $user->id;
            $alert->alert_id          = AlertType::ACCRUAL_OF_DAILY_INVESTMENT;
            $alert->amount            = $profitUsdClear;
            $alert->currency_id       = $transaction->currency_id;
            $alert->marketing_plan_id = $userMarketingPlan->marketing_plan_id;
            $alert->currency_type     = $code;
            $alert->save();

/*$parents = $user->getAllLevelsParent();
$i = 0;
foreach($parents as $p){
$transaction = new Transaction();
 $transaction->user_id = $p['id'];
 $transaction->transaction_type_id = TransactionsTypesConsts::PROFIT_FROM_PARTNER_PROGRAM;
 $transaction->amount_usd = ($profitUsdClear - $bodyUsd)/100 * $p['key'];
 $transaction->balance_usd_after_transaction = $userMarketingPlan->balance_usd + $transaction->amount_usd;
 $transaction->line_number = $i; $i++;
 $transaction->save();

 $alert                = new Alert;
 $alert->user_id       = $p['id'];
 $alert->alert_id      = AlertType::ACCRUAL_OF_REFERRAL_PROFIT;
 $alert->email         = $user->email;
 $alert->amount        = ($profitUsdClear - $bodyUsd)/100 * $p['key'];
 $alert->save();

}*/


            // Увеличиваем баланс инвестиций в коин
//            $b = $user->balance(BalanceTypeConstants::INVEST_TO_COIN, CurrencyConstants::USD);
//            // Если такого типа баланса еще не создан в табл. balances — создаем запись
//            if (is_null($b->first())) {
//                $balance = New Balance;
//                $balance->user_id = $user->id;
//                $balance->balance_type_id = BalanceTypeConstants::INVEST_TO_COIN;
//                $balance->balance = $profiTtoCoinBalance;
//                $balance->currency_id = CurrencyConstants::USD;
//                $balance->save();
//            } else {
//                $t = $b->first();
//                $t->balance += $profiTtoCoinBalance;
//                $t->save();
//            }


        return $profitUsdClear;
    }

    /**
     * Возвращает сумму, которую надо начислить пользователю по депозиту
     *
     * @param User $user
     * @param MarketingPlan $marketingPlan
     * @param UserMarketingPlan $userMarketingPlan
     * @return float
     */
    public function getAccrueAmount(User $user, MarketingPlan $marketingPlan, UserMarketingPlan $userMarketingPlan): float
    {
        // Если надо начислять простой процент
        return $this->isAccrualSimplePercent($marketingPlan, $userMarketingPlan)
            ? $userMarketingPlan->invested_usd
            : $userMarketingPlan->balance_usd;
    }

    /**
     * Выполняет начисления пользователям по иерархии выше согласно маркетингу.
     *
     * @param User $user
     * @param float $profit Сумма прибыли от депозита, полученная реферальным пользователем
     * @param Collection $referral_accrual_params
     */
    public function createProfitReferralsTransactions()
    {
        // Получаем список пользователей с их уровнем в иерархии (поле depth)
        User::with('userMarketingPlan')->with('marketingPlan')->withDepth()->chunk(100, function ($users) {
            // По каждому пользователю выполняем начисления от его рефералов, неходящихся ниже
            $users->each(function ($user) {
                $this->accrue_log->info($user->email . ' ------------ Начисляем реферальные пользователю ------- ');

                // Получаем маркетинговый план пользователя
                $userMarketingPlan = $user->userMarketingPlan()->first();
                // Если (у пользователя есть маркетинговый план) && (Надо ли в текущий день выполнять начисления с учетом буднего/выходного дня и параметров плана пользователя)
                if (!is_null($userMarketingPlan) && ($this->isNeedToAccrueInViewOfWeekdayOrWeekend($user))) {
                    // Получаем параметры начислений от дохода партнера (id = 1) по линиям
                    $marketingPlanPartnerPrograms = $user->marketingPlan()->first()->marketingPlanPartnerPrograms(1)->get();

                    /**
                     * @var float Общая прибыль, полученная по партнерской программе
                     */
                    $total_partner_program_profit = 0;
                    /**
                     * @var float Общая прибыль, начисленная на баланс коина
                     */
                    $total_to_coin_balance = 0;
                    // По всем линиям партнерской программы
                    foreach ($marketingPlanPartnerPrograms as $marketingPlanPartnerProgram) {
                        // Возвращает потомков, находящихся на $level уровне ниже
                        $descendantsOnLevel = $user->getDescendants($marketingPlanPartnerProgram->line_number);
                        $this->accrue_log->info("           Определяем доход от линии $marketingPlanPartnerProgram->line_number.");
                        /**
                         * @var float Общий доход рефералов, находящихся на линии
                         */
                        $lineProfit = 0;
                        // Определяем доход, полученный линией
                        foreach ($descendantsOnLevel as $descendantOnLevel) {
                            $this->accrue_log->info("               Доход, полученный $descendantOnLevel->email — $$descendantOnLevel->last_marketing_plan_profit.");
                            // Учитываем только доход, если убыток — не учитываем
                            if ($descendantOnLevel->last_marketing_plan_profit > 0) {
                                $lineProfit += $descendantOnLevel->last_marketing_plan_profit;
                            }
                        }
                        // Рассчитываем прибыль (без учета отчислений на коин)
                        $profitFromLine = $lineProfit / 100 * $marketingPlanPartnerProgram->profit;
                        // Определяем, какой % отчисляем на коин
                        $coinPercent = $user->marketingPlan->coin_percent;
                        // Сумма usd, которая начисляется на баланс коина
                        $profiTtoCoinBalance = $profitFromLine / 100 * $coinPercent;
                        // Прибыль минус отчисления на коин
                        $profitUsdClear = $profitFromLine - $profiTtoCoinBalance;
                        $this->accrue_log->info("           Общий доход от линии $marketingPlanPartnerProgram->line_number — $$profitFromLine (общий доход линии $$lineProfit, партнерка линии $marketingPlanPartnerProgram->profit%).
                        Отчисляем на коин $coinPercent% ($$profiTtoCoinBalance). Зачисляем на баланс от реферальных: $$profitUsdClear.");
                        //
                        if ($profitFromLine > 0.01) {
                            // Создаем транзакцию - прибыль от реферальной программы
                            $transaction = new Transaction();
                            $transaction->user_id = $user->id;
                            $transaction->transaction_type_id = TransactionsTypesConsts::PROFIT_FROM_PARTNER_PROGRAM;
                            $transaction->amount_usd = $profitUsdClear;
                            $transaction->balance_usd_after_transaction = $userMarketingPlan->balance_usd + $profitFromLine;
                            $transaction->line_number = $marketingPlanPartnerProgram->line_number;
                            $transaction->save();
                            // Накапливаем общую прибыль по партнерской программе
                            $total_partner_program_profit += $profitUsdClear;
                            // Накапливаем общую сумму отчислений на коин
                            $total_to_coin_balance += $profiTtoCoinBalance;
                        }
                    }
                    $this->accrue_log->info("  **Всего $user->email начислено реферальных: $" . round($total_partner_program_profit, 2) . ". Всего начислено на баланс коина: $" . round($total_to_coin_balance) . ".");
                    // Добавляем сумму на баланс маркетингового плана
                    $userMarketingPlan->balance_usd += $total_partner_program_profit;
                    // Добавляем сумму на баланс партнерских на маркетинговом плане
                    $userMarketingPlan->partner_profit_usd += $total_partner_program_profit;
                    // Добавляем на баланс коина в маркетинговом плане
                    $userMarketingPlan->coin_usd += $total_to_coin_balance;
                    // Увеличиваем общие баланс отчислений в коин
                    $b = $user->balance(BalanceTypeConstants::INVEST_TO_COIN, CurrencyConstants::USD);
                    // Если такого типа баланса еще не создан в табл. balances — создаем запись
                    if (is_null($b->first())) {
                        $balance = New Balance;
                        $balance->user_id = $user->id;
                        $balance->balance_type_id = BalanceTypeConstants::INVEST_TO_COIN;
                        $balance->balance = $total_to_coin_balance;
                        $balance->currency_id = CurrencyConstants::USD;
                        $balance->save();
                    } else {
                        $t = $b->first();
                        $t->balance += $total_to_coin_balance;
                        $t->save();
                    }


                    $userMarketingPlan->save();

                    // Проверяем и, при необходимости, закрываем маркетинг-план (при начислении прибыли закрывать нельзя, поскольку в последний день не будут начислены реферальные, т.к. план будет закрыт)
                    $marketingPlan = $user->marketingPlan()->first();
                    if ($this->isLastAccrue($marketingPlan, $userMarketingPlan)) {
                        $this->closePlan($user, $userMarketingPlan);
                    }
                } else {
                    $this->accrue_log->info('У пользователя нет активного маркетингового плана или планом не предусмотрено начисление в этот день.');
                }
            });
        });
    }

    /**
     * Удаляет накопившиеся id исходящих не выполненных пополнений
     */
    public function deleteOldOutgoingPayments()
    {
        OutgoingPayments::where('created_at', '<', Carbon::now()->subDays(4))
            ->where('received_at', '0000-00-00 00:00:00')
            ->delete();
    }

    /**
     * Возвращает парамтеры начислений за рефералов
     *
     * @return mixed
     */
    public function getReferralAccrualParams()
    {
        return ReferralAccrualParam::where('accrue', true)->get();
    }

}
