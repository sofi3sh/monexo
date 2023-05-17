<?php

namespace App\Models;

use App\Models\Home\Transaction;
use App\Models\Home\UserMarketingPlan;
use Illuminate\Support\Facades\DB;
use App\Models\Consts\TransactionsTypesConsts;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * Class UserStatisticFull
 * @package App\Models
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\User[] referrals
 */

class UserStatisticFull
{
    const STARTING_POINT_CLOSE_MARKETING_PLAN = '2021-01-16 00:00:00';

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->transaction = $this->user->hasMany('App\Models\Home\Transaction');
    }

    /**
     * Возвращает количество рефералов всех уровней.
     *
     * @return int|mixed
     */
    public function getReferralsCount()
    {
        return $this->user->recursiveRefferalsCount();
    }

    /**
     * Возвращает сумму закрытых пакетов
     *
     * @param array $arrayUserId
     * @return mixed
     */
    private function getSumClosedPackages(array $arrayUserId)
    {
        return 0;
//        return UserMarketingPlan::whereIn('user_id', $arrayUserId)
//            ->where('end_at', '>=', self::STARTING_POINT_CLOSE_MARKETING_PLAN)
//            ->sum('invested_usd');

//        return Transaction::where('transaction_type_id', TransactionsTypesConsts::TRANSFER_BODY_FROM_MARKETING_PLAN_TO_MAIN_BALANCE)
//            ->whereIn('user_id', $arrayUserId)
//            ->sum('amount_usd');

//        return $this->hasMany('App\Models\Home\Transaction', 'user_id', 'id')
//            ->where('transaction_type_id', TransactionsTypesConsts::TRANSFER_BODY_FROM_MARKETING_PLAN_TO_MAIN_BALANCE)
//            ->sum('amount_usd');
    }

    /**
     * Возвращает всего инвестиций.
     *
     * @return float
     */
    public function getTotalInvestment()
    {
        // Сумма инвестици
        $sumInvested = $this->user->invested_usd;
        // Сумма закрытых пакетов
        $sumClosedPackages = $this->getSumClosedPackages( [ $this->user->id ] );

        return $sumInvested - $sumClosedPackages;
    }

    /**
     * Прибыль от инвестиций.
     *
     * @return mixed
     */
    public function investmentProfitUsd()
    {
        $cloneTransaction = clone $this->transaction;
        return $cloneTransaction
            ->where('transaction_type_id', TransactionsTypesConsts::PROFIT_TYPE_ID)
            ->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));
    }

    /**
     * Возвращает обороты первой линии.
     *
     * @return string
     */
    public function getTurnoverOneLine()
    {
        // Если сумма собственных инвестиций == 0 то и оборот == 0
        if ($this->user->invested_usd <= 0) {
            return 0;
        }

        // Сумма инвестиций рефералов первого уровня
        /*$sumInvested = $this->user->refferrals()->sum('invested_usd');

        // Если рефералы 1-го уровня покупали сервисы то суммируем сколько они на это потратили денег
        $cloneTransaction = clone $this->transaction;
        $sumServices = $cloneTransaction
            ->where('transaction_type_id', TransactionsTypesConsts::SERVICES_REFERRAL_ONE_LINE)
            ->sum('amount_usd');

        // Суммируем пакеты которые позакрывали рефералы 1-го уровня.
        $sumClosedPackages = $this->getSumClosedPackages( $this->user->refferrals->getQueueableIds() );

        return $sumInvested + $sumServices - $sumClosedPackages; */

        // Сумма инвестиций рефералов первого уровня
        return UserMarketingPlan::whereIn('user_id', $this->user->refferrals->getQueueableIds())->whereNull('end_at')->sum('invested_usd');
    }

    /**
     * Возвращает сумму оборотв команды.
     *
     * @return mixed
     */
    public function teamTurnover()
    {
        // Если сумма собственных инвестиций == 0 то и оборот == 0
        if ($this->user->invested_usd <= 0) {
            return 0;
        }

        $ids = [];
        $this->user->allRefferralsIds( $this->user, $ids );
        $ids = array_values( array_filter($ids) );

        // Сумма инвестиций рефералов всех уровней

        return UserMarketingPlan::whereIn('user_id', $ids)->whereNull('end_at')->sum('invested_usd') -
               UserMarketingPlan::whereIn('user_id', $this->user->refferrals->getQueueableIds())->whereNull('end_at')->sum('invested_usd');

        /*$sumInvested =  Transaction::whereIn('user_id', $ids)
            ->whereIn('transaction_type_id', [
                TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE,
                TransactionsTypesConsts::SERVICES_REFERRAL_TEAM_TURNOVER,
            ])
            ->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));*/

        // Сумма закрытых пакетов рефералов всех уровней.
        //$sumClosedPackages = $this->getSumClosedPackages( $ids );
//        \Cache::set($cacheKey, $sumInvested, 300);

        //return abs($sumInvested) - $sumClosedPackages;
    }

    /**
     * Всего пополнений.
     *
     * @return mixed
     */
    public function getAllReplenishment()
    {
        $cloneTransaction = clone $this->transaction;
        return $cloneTransaction
            ->whereIn('transaction_type_id', [
                TransactionsTypesConsts::INVEST_TYPE_ID,
                TransactionsTypesConsts::ACCRUED_THROUGH_ADMIN
            ])
            ->sum('amount_usd');
    }

    /**
     * Всего выведено.
     *
     * @return mixed
     */
    public function getAllWithdrawal()
    {
        $cloneTransaction = clone $this->transaction;
        return $cloneTransaction
            ->where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_TYPE_ID)
            ->value(DB::raw("abs(SUM(amount_usd)) + abs(IFNULL(sum(amount_crypto),0))"));
    }

    /**
     * Прибыль по партнерке.
     *
     * @return mixed
     */
    public function getProfitAffiliateProgram()
    {
        // В шаблоне было referrals_usd + bonusCareer
        $referralUSD = $this->user->referrals_usd;

        $cloneTransaction = clone $this->transaction;
        $bonusCareer = $cloneTransaction
            ->whereIn('transaction_type_id', [
                TransactionsTypesConsts::BONUSES_TYPE_ID,
                TransactionsTypesConsts::SERVICES_REFERRAL_BONUS
            ])
            ->sum('amount_usd');

        return $referralUSD + $bonusCareer;
    }

    public function sendByTransfer() {
        return Transaction::where([
            'user_id' => $this->user->id,
            'transaction_type_id' => TransactionsTypesConsts::USER_TRANSFER_SEND,
        ])
        ->sum('amount_usd');
    }
    
    public function receivedByTransfer() {
        return Transaction::where([
            'user_id' => $this->user->id,
            'transaction_type_id' => TransactionsTypesConsts::USER_TRANSFER_GET,
        ])
        ->sum('amount_usd');
    }

}
