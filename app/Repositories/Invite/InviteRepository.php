<?php

namespace App\Repositories\Invite;

use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\ReferralDeposit;
use App\Models\Home\Transaction;
use App\Models\Home\UserMarketingPlan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InviteRepository
{
    private string $dateFrom;
    private string $dateTo;

    public function __construct(string $dateFrom, string $dateTo)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    /**
     * Статистика инвайтов за период.
     *
     * @return array
     */
    public function getStatisticsInvitePeriod() : array
    {
        return [
            'total'     => $this->getTotal(),
            'activated' => $this->getActivated(),
            'pending'   => $this->getPending(),
            'expired'   => $this->getExpired(),
        ];
    }

    /**
     * Общие количество.
     *
     * @return float
     */
    private function getTotal() : float
    {
        return ReferralDeposit::on()
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            ->count();
    }

    /**
     * Из них активировано.
     *
     * @return float
     */
    private function getActivated() : float
    {
        return ReferralDeposit::on()
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            // 0 - не зачислено реферралу, 1 - зачислено
            ->where('is_accrued', 1)
            ->count();
    }

    /**
     * Из них в ожидании.
     *
     * @return float
     */
    private function getPending() : float
    {
        return ReferralDeposit::on()
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            // 0 - не зачислено реферралу, 1 - зачислено
            ->where('is_accrued', 0)
            // 0 - инвайт не был отменен, 1 - его отменил крон
            ->where('reset_invite_is', 0)
            ->count();
    }

    /**
     * Из них просрочено.
     *
     * @return float
     */
    private function getExpired() : float
    {
        return ReferralDeposit::on()
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            // 0 - инвайт не был отменен, 1 - его отменил крон
            ->where('reset_invite_is', 1)
            ->count();
    }

    /**
     * топ-10 отправителей инвайтов, которые активированы, с количеством для каждого отправителя
     *
     * @return array
     */
    public function getTopSenderInvite() : array
    {
        return ReferralDeposit::on()
            ->select('users.email', DB::raw('count(user_id) as count_package'))
            ->leftJoin('users', 'referral_deposit.user_id', '=', 'users.id')
            ->where('is_accrued', 1)
            ->groupBy('user_id')
            ->orderBy('count_package', 'desc')
            ->limit(10)
            ->get(['user_id'])
            ->toArray();
    }

    /**
     * количество открытых пакетов с помощью инвайтов
     *
     * @return int
     */
    public function getCountPackageInvite() : int
    {
        return ReferralDeposit::on()
            // 0 - не зачислено реферралу, 1 - зачислено
            ->where('is_accrued', 1)
            ->count('*');
    }

    /**
     * сумма открытых пакетов с помощью инвайтов
     *
     * @return float
     */
    public function getSumPackageInvite() : float
    {
        return ReferralDeposit::on()
            // 0 - не зачислено реферралу, 1 - зачислено
            ->where('is_accrued', 1)
            ->sum('amount_usd');
    }

    /**
     * сумма внутренних переводов
     *
     * @return float
     */
    public function getSumInternalTransfer() : float
    {
        return Transaction::on()
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            // Пользовательский перевод (получение)
            ->where('transaction_type_id', TransactionsTypesConsts::USER_TRANSFER_GET)
            // Пользовательский перевод (получение)
//            ->where('transaction_type_id', TransactionsTypesConsts::USER_TRANSFER_SEND)
            // Перевод средств между аккаунтами
//            ->where('transaction_type_id', TransactionsTypesConsts::TRANSFER_BETWEEN_ACCOUNTS_TYPE_ID)
            ->sum('amount_usd');
    }

    /**
     * количество открытых пакетов
     *
     * @return int
     */
    public function getCountOpenPackage() : int
    {
        return UserMarketingPlan::on()
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            ->whereNull('deleted_at')
            ->whereNull('end_at')
            ->count();
    }

    /**
     * количество закрытых пакетов
     *
     * @return int
     */
    public function getCountClosePackage() : int
    {
        return UserMarketingPlan::on()
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            ->whereNull('deleted_at')
            ->whereNotNull('end_at')
            ->count();
    }

    /**
     * список пакетов в порядке убывания прибыльности (количества выведенных на баланс средств), рядом суммы вывода
     *
     * @return string
     */
    public function getListPackages()
    {
        return 0;
    }

    /**
     * сумма пополнений
     *
     * @return float
     */
    public function getReplenishmentAmount() : float
    {
        return Transaction::on()
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            // Ввод средств
            ->where('transaction_type_id', TransactionsTypesConsts::INVEST_TYPE_ID)
            ->sum('amount_usd');
    }

    /**
     * выплачено бонусов по линейной программе
     *
     * @return float
     */
    public function getBonusLineProgram() : float
    {
        return Transaction::on()
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            // Ввод средств
            ->where('transaction_type_id', TransactionsTypesConsts::PROFIT_TYPE_ID)
            ->sum('amount_usd');
    }

    /**
     * выплачено обычных бонусов по карьерной программе
     *
     * @return float
     */
    public function getBonusCareerProgram() : float
    {
        return Transaction::on()
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            // Бонус
            ->where('transaction_type_id', TransactionsTypesConsts::BONUSES_TYPE_ID)
            ->sum('amount_usd');
    }

    /**
     * выплачено матчинг-бонусов
     *
     * @return float
     */
    public function getMatchingBonus() : float
    {
        return Transaction::on()
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            // Матчинг бонус
            ->where('transaction_type_id', TransactionsTypesConsts::MATCHING_BONUS)
            ->sum('amount_usd');
    }

    /**
     * топ-10 пользователей по сумме внутренних переводов.
     *
     * @return array
     */
    public function getSumInternalTransferTop(): array
    {
        return Transaction::on()
            ->select('users.email', DB::raw('sum(transactions.amount_usd) as withdrawal_amount'))
            ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
            ->whereBetween('transactions.created_at', [$this->dateFrom, $this->dateTo])
            // Заявка на вывод
            ->where('transactions.transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID)
            ->whereNotNull('users.email')
            ->onlyTrashed()
            ->groupBy('users.email')
            ->orderBy('withdrawal_amount', 'asc')
            ->limit(10)
            ->get()
            ->toArray();
    }

    /**
     * Также добавить блок с рейтингом городов по количеству зарегистрированных пользователей
     *
     * @return array
     */
    public function getCities(): array
    {
        return User::on()
            ->select('city', DB::raw('count(*) as count_city'))
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            ->whereNotNull('city')
            ->groupBy('city')
            ->orderBy('count_city', 'desc')
            ->limit(10)
            ->get()
            ->toArray();
    }

    /**
     * Всего комиссии по инвайтам.
     *
     * @return float
     */
    public function getTotalCommissionInvite(): float
    {
        return (float) ReferralDeposit::on()
            ->select(DB::raw('sum(amount_usd / 100 * commission_percent) as profit'))
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            ->where('is_accrued', 1)
            ->where('reset_invite_is', 0)
            ->pluck('profit')
            ->first();
    }

    /**
     * Топ 10 пользователей. Комиссии по инвайтам.
     * @return array
     */
    public function getTopUserCommissionInvite(): array
    {
        return ReferralDeposit::on()
            ->select(DB::raw('users.email, sum(referral_deposit.amount_usd / 100 * referral_deposit.commission_percent) as profit'))
            ->leftJoin('users', 'referral_deposit.user_id', '=', 'users.id')
            ->where('referral_deposit.is_accrued', 1)
            ->where('referral_deposit.reset_invite_is', 0)
            ->whereBetween('referral_deposit.created_at', [$this->dateFrom, $this->dateTo])
            ->whereNotNull('users.email')
            ->groupBy('referral_deposit.user_id')
            ->orderBy('profit', 'desc')
            ->limit(10)
            ->get()
            ->toArray();
    }

    /**
     * Всего комиссии по выводам.
     *
     * @return float
     */
    public function getTotalCommissionConclusions()
    {
        return (float) Transaction::on()
            // id типа транзкции "Вывод"
            ->where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_TYPE_ID)
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            ->sum('commission');
    }

    /**
     * Топ 10 пользователей. Всего комиссии по выводам.
     *
     * @return array
     */
    public function getTopCommissionConclusions(): array
    {
        return Transaction::on()
            ->select('users.email', DB::raw('sum(transactions.commission) as transactions_commission'))
            ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
            // id типа транзкции "Вывод"
            ->where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_TYPE_ID)
            ->whereBetween('transactions.created_at', [$this->dateFrom, $this->dateTo])
            ->groupBy('users.email')
            ->orderBy('transactions_commission', 'desc')
            ->limit(10)
            ->get()
            ->toArray();
    }

    /**
     * Всего комиссии по внутренним переводам.
     *
     * @return float
     */
    public function getTotalCommissionInternalTransfer(): float
    {
        return (float) Transaction::on()
            // "Пользовательский перевод (отправка)"
            ->select(DB::raw('sum(amount_usd / 100 * commission) as profit'))
            ->where('transaction_type_id', TransactionsTypesConsts::USER_TRANSFER_SEND)
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            ->pluck('profit')
            ->first();
    }

    /**
     * Топ 10 пользователей. Всего комиссии по внутренним переводам.
     *
     * @return array
     */
    public function getTopCommissionInternalTransfer(): array
    {
        return Transaction::on()
            // "Пользовательский перевод (отправка)"
            ->select('users.email', DB::raw('sum(transactions.amount_usd / 100 * transactions.commission) as profit'))
            ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
            ->where('transactions.transaction_type_id', TransactionsTypesConsts::USER_TRANSFER_SEND)
            ->whereBetween('transactions.created_at', [$this->dateFrom, $this->dateTo])
            ->groupBy('users.email')
            ->orderBy('profit', 'desc')
            ->limit(10)
            ->get()
            ->toArray();
    }

    /**
     * Долг по паетам.
     *
     * @return float
     */
    public function getDebtDeposit(): float
    {
        $marketingPlanIds = [
            1,	// Start	0.7
            2,	// Profi	0.8
            3,	// Optimus	0.9
            4,	// President 1
            12, //	Standard 50$	0.7
            13, //	Standard 250$	0.7
            14, //	Standard 500$	0.8
            15, //	Standard 1000$	0.8
            16, //	Standard 2500$	0.9
            17, //	Standard 5000$	1
            23, //	Standard 10000$	1
        ];

//        $marketingPlanPercent = MarketingPlan::on()
//            ->whereIn('id', $marketingPlanIds)
//            ->select('id', 'daily_percent')
//            ->get()
//            ->toArray();

        $debtDeposit = UserMarketingPlan::on()
            ->select(DB::raw('sum(user_marketing_plans.invested_usd / 100 * marketing_plans.daily_percent * 
            (
                CASE
                   WHEN user_marketing_plans.marketing_plan_id = 24 
                        THEN FLOOR(user_marketing_plans.days_left / 7)
                   ELSE user_marketing_plans.days_left
                END
            )) as debt'))
            ->leftJoin('marketing_plans', 'user_marketing_plans.marketing_plan_id', '=', 'marketing_plans.id')
            ->whereNull('user_marketing_plans.deleted_at')
            ->whereNull('user_marketing_plans.end_at')
            ->where('user_marketing_plans.days_left', '>', 0)
            ->whereIn('user_marketing_plans.marketing_plan_id', $marketingPlanIds)
            ->pluck('debt')
            ->first();

        return $debtDeposit;
    }

    /**
     * Долг по пакетам плавающий (средний процент).
     *
     * @return float
     */
    public function getDebtDepositFloating(): float
    {
        $marketingPlanIds = [
            18,	// Business	    1.5:2.1         1.8
            22,	// Mini	        0.53:0.77       0.65
            24,	// Light	    1.3:2.1         1.7
            26,	// Mini	        0.41:0.55       0.48
        ];

        $debtDepositFloating = UserMarketingPlan::on()
            ->select(DB::raw('sum(user_marketing_plans.invested_usd / 100 *
                                    (
                                    case
                                        when user_marketing_plans.marketing_plan_id = 18 then 1.8 
                                        when user_marketing_plans.marketing_plan_id = 22 then 0.65
                                        when user_marketing_plans.marketing_plan_id = 24 then 1.7
                                        when user_marketing_plans.marketing_plan_id = 26 then 0.48 
                                    end
                                    )
                                    * 
                                    (
                                    CASE
                                       WHEN user_marketing_plans.marketing_plan_id = 24 
                                            THEN (user_marketing_plans.days_left / 7)
                                       ELSE user_marketing_plans.days_left
                                    END
                                    )) as debt'))
            ->leftJoin('marketing_plans', 'user_marketing_plans.marketing_plan_id', '=', 'marketing_plans.id')
            ->whereNull('user_marketing_plans.deleted_at')
            ->whereNull('user_marketing_plans.end_at')
            ->where('user_marketing_plans.days_left', '>', 0)
            ->whereIn('user_marketing_plans.marketing_plan_id', $marketingPlanIds)
            ->pluck('debt')
            ->first();

        return $debtDepositFloating;
    }
}
