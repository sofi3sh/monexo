<?php

namespace App\Models\Home;

use App\Models\User;
use App\Models\Consts\AlertType;
use App\Models\Consts\TransactionsTypesConsts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Home\UserMarketingPlan
 *
 * @property int $id
 * @property int $user_id id маркетингового плана
 * @property int $from_user_id id пользователя, котоырй открыл пакет
 * @property int $marketing_plan_id id маркетингового плана
 * @property float $invested_usd Инвестированная в план сумма
 * @property float $invested_eth
 * @property float $invested_btc
 * @property float $invested_pzm
 * @property float $balance_usd Текущий баланс на маркетинговом плане
 * @property float $balance_eth
 * @property float $balance_btc
 * @property float $balance_pzm
 * @property float $profit_usd Полученная прибыль
 * @property float $profit_eth
 * @property float $profit_btc
 * @property float $profit_pzm
 * @property float $rate курс
 * @property float $partner_profit_usd Полученная прибыль по партнерской программе (по доходу партнера)
 * @property float $coin_usd Сумма на балансе коина
 * @property \Illuminate\Support\Carbon $start_at Дата начала действия плана
 * @property \Illuminate\Support\Carbon $stop_at Дата остановки пакета пользователем
 * @property string|null $end_at Дата окончания действия плана
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $days_left Остаток дней работі инвест плана
 * @property-read \App\Models\Home\MarketingPlan $marketingPlan
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereBalanceBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereBalanceEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereBalancePzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereBalanceUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereCoinUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereDaysLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereInvestedBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereInvestedEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereInvestedPzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereInvestedUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereMarketingPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan wherePartnerProfitUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereProfitBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereProfitEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereProfitPzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereProfitUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereUserId($value)
 * @mixin \Eloquent
 */
class UserMarketingPlan extends Model
{
    protected $dates = ['start_at'];

    protected $fillable = [
        'user_id',
        'from_user_id',
        'marketing_plan_id',
        'balance_usd',
        'invested_usd',
        'start_at',
        'days_left',
        'invested_eth',
        'invested_btc',
        'balance_eth',
        'balance_btc',
        'profit_eth',
        'profit_btc',
        'invested_pzm',
        'balance_pzm',
        'profit_pzm'
    ];

    public function marketingPlan(): BelongsTo
    {
        return $this->BelongsTo(MarketingPlan::Class, 'marketing_plan_id', 'id');
    }

    /**
     * Остановка активного пакета
     *
     * @return bool
     */
    public function stop(): bool
    {
        if ($this->end_at !== null) {
            return false;
        }

        $this->end_at = Carbon::now();

        return $this->save();
    }

    /**
     * Проверка, что пакет остановлен, но не закрыт
     *
     * @return bool
     */
    public function isStopped(): bool
    {
        if ($this->end_at !== null) {
            return false;
        }

        return $this->stop_at !== null;
    }

    /**
     * Остановка активного пакета на паузу (не полное закрытие)
     *
     * @return bool
     */
    public function stopWithoutClose(): bool
    {
        if ($this->end_at !== null) {
            return false;
        }

        $this->stop_at = Carbon::now();

        return $this->save();
    }

    /**
     * Вывод заработанных средств с пакета на основной баланс пользователя
     */
    public function withdrawProfit()
    {
        $code = $this->marketingPlan->currency_type;
        $codeAmount = 'amount_' . $code;
        $codeProfit = 'profit_' . $code;
        $codeBalans = 'balance_' . $code;
        $codeInvested = 'invested_' . $code;
        $code_balance_after_transaction = 'balance_' . $code . '_after_transaction';

        if (!$this->$codeProfit || $this->$codeProfit <= 0) {
            return;
        }

        // Создаем транзакцию - прибыль от инвест. в маркетинговый план
        $transaction = new Transaction();
        $transaction->user_id = $this->user_id;
        $transaction->transaction_type_id = TransactionsTypesConsts::PROFIT_TYPE_ID;
        $transaction->$codeAmount = $this->$codeProfit;
        if ($code != 'usd') {
            $transaction->amount_crypto = $this->$codeProfit;
        }

        $transaction->$code_balance_after_transaction = $this->$codeBalans + $this->$codeProfit;
        $transaction->save(); // после сохранения обновляется баланс пользователя

        // оповещение о выводе прибыли с пакета
        $alert                    = new Alert();
        $alert->user_id           = $this->user_id;
        $alert->alert_id          = AlertType::WITHDRAW_PACKAGE_PROFIT;
        $alert->amount            = $this->$codeProfit;
        $alert->currency_id       = $transaction->currency_id;
        $alert->marketing_plan_id = $this->marketing_plan_id;
        $alert->currency_type     = $code;
        $alert->save();

        // обнуление прибыли по пакету
        $this->$codeProfit = 0;
        $this->save();
    }

    /**
     * Проверка, что пакет активный
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->end_at === null;
    }

    /**
     * Добавление пригласительного пакета и его активация для пользователя
     *
     * @param User $user
     * @param User|null $fromUser
     * @throws \Throwable
     */
    public static function addInvitationMarketingPlan(User $user, User $fromUser = null)
    {
        $marketingPlan = MarketingPlan::find(MarketingPlan::MP_USD_INVITATION);

        if (!$marketingPlan) {
            return;
        }

        if (!$fromUser) {
            $fromUser = auth()->user();
        }

        \DB::transaction(function () use ($user, $fromUser, $marketingPlan) {
            $userMarketingPlan = new UserMarketingPlan;
            $userMarketingPlan->user_id = $user->id;
            $userMarketingPlan->from_user_id = $fromUser->id;
            $userMarketingPlan->marketing_plan_id = $marketingPlan->id;
            $userMarketingPlan->balance_usd = 0;
            $userMarketingPlan->days_left = $marketingPlan->max_duration;
            $userMarketingPlan->invested_usd = $marketingPlan->min_invest_sum;
            $userMarketingPlan->start_at = Carbon::now();
            $userMarketingPlan->save();

            $alert = new Alert;
            $alert->user_id = $user->id;
            $alert->alert_id = AlertType::OPENING_INVESTMENT;
            $alert->marketing_plan_id = $marketingPlan->id;
            $alert->amount = $userMarketingPlan->invested_usd;
            $alert->save();

            $transaction = new Transaction;
            $transaction->user_id = $user->id;
            $transaction->transaction_type_id = TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE;
            $transaction->amount_usd = -0;
            $transaction->balance_usd_after_transaction = $user->balance_usd ?: 0;
            $transaction->save();
        });
    }
}
