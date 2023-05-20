<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Home\MarketingPlan
 *
 * @property int $id
 * @property string $name Название плана
 * @property string $currency_type
 * @property float $min_invest_sum Минимальная сумма инвестирования в пакет
 * @property float $max_invest_sum Максимальная сумма инвестирования в пакет
 * @property int $min_duration Минимальная длительность работы депозита
 * @property int $max_duration Максимальная длительность работы депозита
 * @property int $first_days_count_for_simple_percent Кол-во первых дней, когда начисляются простые проценты.
 * @property float|null $daily_percent
 * @property int $only_business_days Признак, что начислять только в рабочие дни
 * @property float $min_profit Минимальная прибыль
 * @property float $max_profit Максимальная прибыль в день
 * @property float|null $manual_percent Процент следующих начислений, указанный вручную.
 * @property float $min_withdrawal_request Ограничение на создание заявки на вывод при активном плане
 * @property float $coin_percent % прибыли, который переводится на счет коина
 * @property int $available_for_withdrawal Доступно к выводу
 * @property float|null $withdrawal_commission Комиссия на вывод
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Home\MarketingPlan $marketingPlan
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MarketingPlan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereAvailableForWithdrawal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereCoinPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereCurrencyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereDailyPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereFirstDaysCountForSimplePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereManualPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereMaxDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereMaxInvestSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereMaxProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereMinDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereMinInvestSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereMinProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereMinWithdrawalRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereOnlyBusinessDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereWithdrawalCommission($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MarketingPlan withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MarketingPlan withoutTrashed()
 * @mixin \Eloquent
 */
class MarketingPlan extends Model
{
    const GROUP_STANDARD = 'Standard';
    const GROUP_CRYPTO_BUSINESS = 'CryptoBusiness';
    const GROUP_BUSINESS = 'Business';
    const GROUP_MINI = 'Mini';
    const GROUP_LIGHT = 'Light';
    const GROUP_NEW_LIGHT = 'New Light';

    const MP_BTC_INVITATION = 19;
    const MP_PZM_INVITATION = 20;
    const MP_ETH_INVITATION = 21;
    const MP_USD_INVITATION = 25;

    protected $table = 'marketing_plans';
    protected $appends = ['describe'];

    use SoftDeletes;

    /**
     * Параметры партнерских программ
     *
     * @param $partnerProgramId - id партнерской программы (1 - от дохода партнера, 2 - от инвестиций)
     * @return HasMany
     */
    public function marketingPlanPartnerPrograms($partnerProgramId): HasMany
    {
        return $this->hasMany(MarketingPlanPartnerProgram::class)
            ->where('partner_program_id', $partnerProgramId)
            ->whereNull('deleted_at');
    }

    public function marketingPlan(){
        return $this->belongsTo('App\Models\Home\MarketingPlan', 'id', 'marketing_plan_id');
    }

    /**
     * Проверка, что это активные пакеты
     *
     * @param string $group Название группы пакетов
     * @return bool
     */
    public function isNewByIdAndName(string $group = ''): bool
    {
        $isId = $this->id >= 12 && $this->id <= 27;

        $isName = $this->name === $group;

        if(!$isName) {
            //if(explode(' ', $this->name)[0] === 'Standard') {
                $isName = $group ? explode(' ', $this->name)[0] === $group : true;
            //}
        }


        return $isId && $isName;
    }


    public function isNotOldMini(string $group = '') : bool
    {
        $isId = $this->id != 22;

        $isName = $group ? explode(' ', $this->name)[0] === $group : true;

        return $isId && $isName;
    }

    // маркетинг планы, доступные к покупке всем пользователям
    public static function whereActivePlansInSystem()
    {
        return static::where('is_active', 1);
    }

    /**
     * Проверка, что пакет бессрочный
     *
     * @return bool
     */
    public function isUnlimitedDuration(): bool
    {
        return $this->isNewByIdAndName(MarketingPlan::GROUP_LIGHT) || $this->isNewByIdAndName(MarketingPlan::GROUP_NEW_LIGHT);
    }

    /**
     * Получение пакетов, разбитых на группы
     *
     * @return array
     */
    public static function getGroups(): array
    {
        $groups = [
            'cssClasses' => [
                //self::GROUP_NEW_LIGHT => 'first',
                self::GROUP_LIGHT => 'first active',
                self::GROUP_MINI => 'second',
//                self::GROUP_STANDARD => 'first',
//                self::GROUP_CRYPTO_BUSINESS => 'second d-none',
//                self::GROUP_BUSINESS => 'third d-none',//'third d-none',
                // self::GROUP_LIGHT => 'third',
//                self::GROUP_MINI => 'four', //'four',
//                self::GROUP_NEW_LIGHT => 'five',
            ],
            'packages' => [
                //self::GROUP_NEW_LIGHT => [],
                self::GROUP_LIGHT => [],
                self::GROUP_MINI => [],
//                self::GROUP_STANDARD => [],
//                self::GROUP_CRYPTO_BUSINESS => [],
//                self::GROUP_BUSINESS => [],
                // self::GROUP_LIGHT => [],
//                self::GROUP_MINI => [],
//                self::GROUP_NEW_LIGHT => [],
            ]
        ];

        // проставка активного класса, если он есть в ссылке
        foreach ($groups['cssClasses'] as $group => &$cssClass) {
            if (isset($_REQUEST['plan'])) {
                if ($group === $_REQUEST['plan']) {
                    $cssClass = "$cssClass active";
                    break;
                }
            } else {
                $cssClass = "$cssClass active";
                break;
            }
        }

        foreach (self::getActive()->get() as $marketingPlan) {
            //$groups['packages'][$marketingPlan->name][] = $marketingPlan;
//            if (strstr($marketingPlan->name, self::GROUP_STANDARD)) {
//                $groups['packages'][self::GROUP_STANDARD][] = $marketingPlan;
//            }
//            if (strstr($marketingPlan->name, self::GROUP_CRYPTO_BUSINESS)) {
//                $groups['packages'][self::GROUP_CRYPTO_BUSINESS][] = $marketingPlan;
//            }
//            if ($marketingPlan->name === self::GROUP_BUSINESS) {
//                $groups['packages'][self::GROUP_BUSINESS][] = $marketingPlan;
//            }
            if (strstr($marketingPlan->name, self::GROUP_MINI)) {
                $groups['packages'][self::GROUP_MINI][] = $marketingPlan;
            }
            if (strstr($marketingPlan->name, self::GROUP_LIGHT)) {
                $groups['packages'][self::GROUP_LIGHT][] = $marketingPlan;
            }
//            if (strstr($marketingPlan->name, self::GROUP_NEW_LIGHT)) {
//                $groups['packages'][self::GROUP_NEW_LIGHT][] = $marketingPlan;
//            }
        }
        //dd($groups);
        return $groups;
    }

    public static function getActive()
    {
        return static::where('is_active', 1);
    }

    public function getDescribeAttribute() {
        return 'desc' . $this->id;
    }
}
