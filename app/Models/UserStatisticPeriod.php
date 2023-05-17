<?php

namespace App\Models;

use App\Console\Commands\AccrueLeadershipBonus;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Consts\AlertType;
use App\Models\Home\Alert;
use App\Models\Home\UserMarketingPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

/**
 * Статистика.
 */
class UserStatisticPeriod
{
    private $fromDate;
    private $toDate;
    private $user;
    private $transaction;

    public function __construct(User $user, $fromDate, $toDate)
    {
        $this->user = $user;
        $this->fromDate = $fromDate . ' 00:00:00';
        $this->toDate = $toDate . ' 23:59:59';

        $this->transaction = $this->user->hasMany('App\Models\Home\Transaction')
            ->whereBetween('created_at', [$this->fromDate, $this->toDate]);
    }

    /**
     * Заработано по карьерной программе:
     *
     * @return float
     */
    public function getCareerProgram(): float
    {
        // Взято с User::bonusCareer
        $cloneTransaction = clone $this->transaction;
        return $cloneTransaction
            ->where('transaction_type_id', TransactionsTypesConsts::BONUSES_TYPE_ID)
            ->sum('amount_usd');
    }

    /**
     * Заработано по линейной программе:
     *
     * @return float
     */
    public function getLinearProgram(): float
    {
        // Заработок на рефералах
        $cloneTransaction = clone $this->transaction;
        return $cloneTransaction
            ->where('transaction_type_id', TransactionsTypesConsts::PROFIT_FROM_PARTNER_PROGRAM)
            ->sum('amount_usd');
    }

    /**
     * Матчинг бонус:
     *
     * @return float
     */
    public function getMatchingBonus(): float
    {
        $cloneTransaction = clone $this->transaction;
        return $cloneTransaction
            ->where('transaction_type_id', TransactionsTypesConsts::MATCHING_BONUS)
            ->sum('amount_usd');
    }

    /**
     * Лидерский бонус
     *
     * @return float
     */
    public function getLeadershipBonus(): float
    {
        $cloneTransaction = clone $this->transaction;
        return $cloneTransaction
            ->whereDate('created_at', '>', AccrueLeadershipBonus::BONUS_START_DATE)
            ->where('transaction_type_id', TransactionsTypesConsts::LEADERSHIP_BONUS)
            ->sum('amount_usd');
    }

    /**
     * Прибыль от инвестиций:
     *
     * @return mixed
     */
    public function getProfitOfInvestments()
    {
        $cloneTransaction = clone $this->transaction;
        return $cloneTransaction
            ->where('transaction_type_id', TransactionsTypesConsts::PROFIT_TYPE_ID)
            ->value(DB::raw("abs(sum(amount_usd)) + ifnull(abs(sum(amount_crypto)),0)"));
    }

    /**
     * Выведено средств:
     *
     * @return mixed
     */
    public function getFundsWithdrawn()
    {
        $cloneTransaction = clone $this->transaction;
        return $cloneTransaction
            ->where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_TYPE_ID)
            ->value(DB::raw("abs(sum(amount_usd)) + ifnull(abs(sum(amount_crypto)),0)"));
    }

    /**
     * Инвестиций:
     *
     * @return mixed
     */
    public function getInvestment()
    {
        $cloneTransaction = clone $this->transaction;
        return $cloneTransaction
            ->where('transaction_type_id', TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE)
            ->value(DB::raw("abs(sum(amount_usd)) + ifnull(abs(sum(amount_crypto)),0) * ifnull(rate, 1)"));
    }

    /**
     * Пополнений за период:
     *
     * @return mixed
     */
    public function getReplenishmentInvest()
    {
        $cloneTransaction = clone $this->transaction;
        return $cloneTransaction
            ->whereIn('transaction_type_id', [
                // id типа транзкции "Ввод средств"
                TransactionsTypesConsts::INVEST_TYPE_ID,
                // id типа транзкции "Депозитный процент"
                TransactionsTypesConsts::ACCRUED_THROUGH_ADMIN])
            ->sum('amount_usd');
    }
}
