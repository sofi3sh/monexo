<?php

namespace App\Models;

use App\Models\Consts\BalanceTypeConstants;
use App\Models\Consts\CurrencyConstants;
use App\Models\Home\MotivationPlan;
use App\Models\Home\Transaction;
use App\Models\Models\Suggestion;
use App\Notifications\ResetPassword;
use App\Services\PhoneVerification\Contracts\MustVerifyPhone;
use App\Services\PhoneVerification\Traits\MustVerifyPhone as MustVerifyPhoneTrait;
use App\Services\TelegramVerification\Traits\MustVerifyTelegram as MustVerifyTelegramTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Support\Carbon;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use App\Models\Home\ArbitrageTrading;
use App\Models\Consts\TransactionsTypesConsts;
use Illuminate\Support\Facades\Log;
use App\Models\Home\UserMarketingPlan;
use App\Models\Home\MarketingPlan;
use App\Models\Home\MarketingPlanPartner;
use App\Models\Home\Balance;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements HasLocalePreference, MustVerifyEmail, MustVerifyPhone, HasMedia
{
    use Notifiable;
    use NodeTrait;
    use SoftDeletes;
    use HasMediaTrait;
    use Notifiable {
        notify as traitNotify;
    }
    use MustVerifyPhoneTrait;
    use MustVerifyTelegramTrait;

    const STARTING_POINT_CLOSE_MARKETING_PLAN = '2021-01-16 00:00:00';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'password',
        'locale',
        'ref_code',
        'parent_id',
        'parent_second_id',
        'parent_third_id',
        'balance_usd',
        'balance_btc',
        'balance_eth',
        'profit_usd',
        'referrals_usd',
        'referrals_usd',
        'withdrawal_usd',
        'withdrawal_request_usd',
        'exchange_name',
        'api_key',
        'avatar',
        'bonuses',
        'visa',
        'mastercard',
        'qiwi',
        'webmoney',
        'yandexMoney',
        'is_trading_account',
        'new_email',
        'country',
        'age',
        'add_contact',
        'invested_eth',
        'invested_btc',
        'invested_eth_to_marketplace',
        'invested_btc_to_marketplace',
        'profit_eth',
        'profit_btc',
        'referrals_eth',
        'referrals_btc',
        'withdrawal_eth',
        'withdrawal_btc',
        'balance_pzm',
        'invested_pzm',
        'invested_pzm_to_marketplace',
        'profit_pzm',
        'referrals_pzm',
        'withdrawal_pzm',
        'telegram_id',
        'telegram_verification_required',
        'telegram_verification_status',
        'is_allow_withdraw_crypto',
        'is_regional_representative',
        'city',
        'date_birthday',
        'is_active',
        'is_verif',
        'debt_usd',
        'verif_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'telegram_verification_required' => 'boolean'
    ];

    protected $append = [
        'children_count',
    ];

    protected $appends = ['register_day'];


    public function children()
    {
        return $this->hasMany(User::class, 'parent_id', 'id');
    }

    public function getChildrenCountAttribute()
    {
        $count = $this->children->count(); //This specific models count

        //Loop through the already loaded children and get their count
        foreach($this->children as $child){
            $count += $child->children->count(); //Sum up the count
        }

        return $count; //Return the result
    }

    /**
     * Возвращает рефералов первого уровня.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany('App\Models\User','parent_id','id');
    }

    /**
     * Атрибут Возраст
     *
     * @param $age
     * @return mixed
     */
    public function getAgeAttribute($age)
    {
        if ($dateBirthday = $this->attributes['date_birthday']) {
            return now()->diffInYears($dateBirthday);
        }

        return $age;
    }

    /**
     * Safe notify.
     *
     * @param $instance
     * @see User::notify()
     */
    public function notify($instance)
    {
        try {
            $this->traitNotify($instance);
        } catch (\Throwable $throwable) {
            Log::error("User notify: {$throwable->getMessage()}");
        }
    }

    public function getLftName()
    {
        return 'left_id';
    }

    public function getRgtName()
    {
        return 'right_id';
    }

    public function getParentIdName()
    {
        return 'parent_id';
    }

    public function registeredViaGoogle()
    {
        return (bool)$this->google_id;
    }

    public static function getDefaultColumns()
    {
        return [User::getLftName(), User::getRgtName(), User::getParentIdName()];
    }

    /**
     * Get the user's preferred locale.
     *
     * @return string
     */
    public function preferredLocale()
    {
        return $this->locale;
    }

    public function getRegisterDayAttribute() {
        return 1;
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    /*public function sendEmailVerificationNotification()
    {
        dispatch(new SendVerificationEmail($this));
    }*/

    /**
     * Возвращает реферальную ссылку пользователя.
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getReferralLink()
    {
        return url('/') . '/?' . config('referrals.referralParamName') . '=' . $this->ref_code;
    }

    /**
     * Возвращает потомков, находящихся на $level уровне ниже
     *
     * @param int $level - уровень, на котором надо вернуть потомков
     * @return mixed
     */
    public function getDescendants($level = 1)
    {
        // В поле depth учитывается абсолютный уровень линии, определяем его
        $absolute_level = $this->depth + $level;
        // Опередеяем рефералов пользователя на уровне (относительном) $i
        return $this->descendants()
            ->withDepth()
            ->having('depth', $absolute_level)
            ->orderBy('id')
            ->get();
    }

    /**
     * Возвращает всех потомков (на всех уровнях) под текущим пользователем
     *
     * @param int $level кол-во уровней
     * @return mixed
     */
    public function getAllLevelsDescendants($level = 1)
    {
        // В поле depth учитывается абсолютный уровень линии, определяем его
        $absolute_level = $this->depth + $level + 1;
        // Опередеяем рефералов пользователя на уровне (относительном) $i
        return $this->descendants()
            ->withDepth()
            ->having('depth', '<=', $absolute_level)
            ->orderBy('id')
            ->get();
    }

    /**
     * Возвращает общее кол-во потомков до $level уровней включительно
     *
     * @param int $level
     * @return mixed
     */
    public function getAllLevelsDescendantsCount($level = 1)
    {
        return $this->getAllLevelsDescendants($level)->count();
    }

    /**
     * Возвращает инвестированную приглашенными пользователями ("оборот структуры")
     *
     * @param int $level
     * @return int
     */
    public function getInvestedSumFromDescendants(int $level)
    {
        $sum = 0;
        foreach (Auth::user()->getAllLevelsDescendants($level) as $user) {
            $sum += $user->invested_usd;
        }

        return $sum;
    }

    /**
     * Возвращает инвестированную приглашенными пользователями cумма в маркетинг ("Инвестиция в маркетинг")
     *
     * @param int $level
     * @return int
     */
    // public function getInvestedSumFromMarketing(int $level)
    // {
    //     $sum = 0;
    //     foreach (Auth::user()->getAllLevelsDescendants($level) as $user) {
    //         if (!is_null($user->getUserMarketingPlan())) {
    //             $sum += $user->getUserMarketingPlan()->invested_usd;
    //         }
    //         // $sum += is_null($user->getUserMarketingPlan()) ? 0 : $user->getUserMarketingPlan()->invested_usd;
    //     }

    //     return $sum;
    // }

    /**
     * Возвращает предков пользователя, находящихся на $level уровней над ним (т.е. вернет $level предков)
     *
     * @param int $level
     */
    public function getAncestors($level = 1)
    {
        $absolute_level = ($this->depth - $level < 0) ? 0 : $this->depth - $level;

        return $this->ancestors()
            ->withDepth()
            ->having('depth', '>=', $absolute_level)
            ->orderBy('id')
            ->get();
    }

    /**
     * Предок пользователя
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ancestor()
    {
        return $this->hasOne('App\Models\User', 'id', 'parent_id');
    }


    public function arbitrageTradingPlan()
    {
        return $this->belongsTo('App\Models\Home\ArbitrageTradingPlan');
    }

    public function motivationPlan()
    {
        return $this->belongsTo('App\Models\Home\MotivationPlan');
    }

    /**
     * Возвращает транзакции пользователя
     *
     * @param int $transaction_type_id
     * @return Collection
     */
    public function getAllTransactions(){
        return $this->hasMany('App\Models\Home\Transaction')->orderByDesc('id');
    }

    public static function getTransactions(int $transaction_type_id): Collection
    {
        return Transaction::where('user_id', Auth::user()->id)
            ->where('transaction_type_id', $transaction_type_id)
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Возвращает допустимую для вывода сумму.
     *
     * @return mixed
     */
    public function getAmountAvailableWithdrawal()
    {
        return $this->balance_usd;
    }

    public function passwordSecurity()
    {
        return $this->hasOne('App\Models\PasswordSecurity');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->nonQueued(); // Без этого не работает
    }

    /**
     * Возвращает баланс пользователя на дату (с учетом заявок на вывод,
     * т.е. баланс уменьшается на сумму созданной заявки
     *
     * @param $date
     * @return mixed
     */
    public function getBalanceOnDate($date)
    {
        return Transaction::where('user_id', $this->id)
            ->where(DB::raw('date(created_at)'), '<=', $date)
            ->whereNull('deleted_at')
            ->sum('amount_usd');
    }

    /**
     * Возвращает активную арбитражную ставку
     *
     * @return mixed
     */
    public function getActiveArbitrageTrading()
    {
        return ArbitrageTrading::where('user_id', $this->id)->whereNull('end')->first();
    }

    public function availableArbitrageCount()
    {
        return is_null($this->arbitrageTradingPlan()->first()) ? 0 :
            ($this->arbitrageTradingPlan()->first()->max_operation_count - $this->executed_arbitrage_count);
    }

    /**
     * Возращает дату/время, когда закончится действие текущего плана арбитражной торговли
     *
     * @return mixed
     */
    public function tradingPlanWillBeEndAt()
    {
        if (!is_null($this->arbitrage_trading_plan_id)) {
            $start = Carbon::parse($this->start_arbitrage_plan_at);

            return $start->addDays($this->arbitrageTradingPlan()->first()->duration);
        } else {
            return null;
        }
    }

    /**
     * Возвращает true, если срок действия активного плана арбитражной торговли закончился,
     * null - если нет активного плана.
     *
     * @return bool|null
     */
    public function isTradingPlanIsEnd()
    {
        if (!is_null($this->arbitrage_trading_plan_id)) {
            $now = Carbon::now();
            // Если кол-во доступных суток арбитражной торговли 0 и начались новые сутки с момента начала торгов предыдущих суток
            return (($this->arbitrage_trade_days_left <= 0) && ($now->diffInHours(Auth::user()->first_day_arbitrage_at) >= 24));
        } else {
            return null;
        }
    }

    /**
     * Общая прибыль, полученная пользователем
     *
     * @return mixed
     */
    public function allUserProfit()
    {
        return Transaction::where('user_id', Auth::user()->id)
            ->whereIn('transaction_type_id', TransactionsTypesConsts::ALL_PROFIT_TYPES)
            ->sum(DB::raw('amount_usd'));
    }

    /**
     * Сумма начислений по депозиту за период
     *
     * @param $start Начало периода
     * @param $end Окончание периода
     * @return float
     */
    public function sumDepositAccruals($start, $end = null)
    {
        return DB::table('transactions')
            ->where('user_id', $this->id)
            ->where('created_at', '>=', $start)
            ->where('created_at', '<=', is_null($end) ? Carbon::now() : $end)
            ->where('transaction_type_id', TransactionsTypesConsts::PROFIT_TYPE_ID)
            ->whereNull('deleted_at')
            ->sum('amount_usd');
    }

    public function sumDepositLast($start)
    {
        return DB::table('transactions')
            ->where('user_id', $this->id)
            ->where('created_at', '>=', $start)
            ->where('transaction_type_id', TransactionsTypesConsts::INVEST_TYPE_ID)
            ->whereNull('deleted_at')
            ->sum('amount_usd');
    }


    /**
     * Сумма начислений за реферов за период
     *
     * @param $start Начало периода
     * @param $end Окончание периода
     * @return float
     */
    public function sumReferralsAccruals($start, $end = null)
    {
        return DB::table('transactions')
            ->where('user_id', $this->id)
            ->where('created_at', '>=', $start)
            ->where('created_at', '<=', is_null($end) ? Carbon::now() : $end)
            ->whereIn('transaction_type_id', TransactionsTypesConsts::ALL_REFERRAL_PROFIT_TYPES)
            ->whereNull('deleted_at')
            ->sum('amount_usd');
    }

    /**
     * Проверяет и, в случае необходимости, понижает мотивационный план пользователя в случае вывода им средств
     *
     */
    public function lowerMotivationPlanIfNecessary()
    {
        $profit_from_user = $this->invested_usd - $this->withdrawal_usd;
        // Находим максимальный план, который можно купить на текущую сумму пользователя
        $motivation_plan = MotivationPlan::where('price', '<=', $profit_from_user)->orderBy('id', 'desc')->first();
        // Если нет плана, который можно купить — закрываем текущий план пользователя
        if (is_null($motivation_plan)) {
            $this->motivation_plan_id = null;
            $this->motivation_plan_start_at = null;
            $this->save();
            Log::channel('actionlog')->info('Закрыли мотивационный план пользователю id=' . $this->id . ' т.к. после вывода недостаточно средств на любой из планов.');
        } elseif ($motivation_plan->id < $this->motivation_plan_id) { // Если найденный макс. план меньше текущего плана — понижаем план
            $this->motivation_plan_id = $motivation_plan->id;
            $this->motivation_plan_start_at = Carbon::now();
            $this->save();
            Log::channel('actionlog')->info('Понизили уровень мотивационного плана пользователю id=' . $this->id . ' до id плана ' . $this->motivation_plan_id);
        }
    }

    /**
     * Возвращает полученный доход от пользователей $ids
     *
     * @param Collection $ids Коллекция id рефералов
     * @return float
     */
    public function profitFromUsers(Collection $ids)
    {
        $ids = $ids->pluck('id')->toArray();
        return DB::table('transactions')
            ->where('transaction_type_id', '>=', 3)
            ->where('transaction_type_id', '<=', 12)
            ->whereIn('related_user_id', $ids)
            ->whereNull('deleted_at')
            ->sum('amount_usd');
    }

    /**
     * Возвращает, доступен ли для покупки мотивационный план
     *
     * @return bool
     */
    public function isMotivationPlanAvailableForPurchase(int $motivation_plan_id)
    {
        $min_balance = MotivationPlan::where('id', $motivation_plan_id)->first()->min_balance;

        return (($this->balance_usd >= $min_balance) && (!$this->is_trading_account) /*&& ($this->motivation_plan_id != $motivation_plan_id)*/);
    }

    public function motivationPlanStatusForPurchase(int $motivation_plan_id)
    {
        // Если мотивационный план доступен для покупки
        $r = $this->isMotivationPlanAvailableForPurchase($motivation_plan_id);

        // Если проверяемый план является активным - возвращаем статус 3
        return ($this->motivation_plan_id == $motivation_plan_id) ? 3 : (int)$r;
    }

    /**
     * @inheritDoc
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify((new ResetPassword([
            'token' => $token,
            'email' => $this->email,
        ]))->locale(\App::getLocale()));
    }

    /**
     * Возвращает коллекцию виртуальных криптокошельков (созданных и доступных для создания)
     *
     * @return \Illuminate\Support\Collection
     */
    public function availableVirtualCryptoWallets()
    {
        return DB::table('currencies')
            ->leftJoin('user_wallets', function ($join) {
                $join->on('currencies.id', '=', 'user_wallets.currency_id');
                $join->where('user_wallets.user_id', $this->id);

            })
            ->where('currencies.is_crypto', 1)
            ->select('user_wallets.currency_id', 'currencies.code', 'currencies.id', 'user_wallets.amount')
            ->get();
    }

    /**
     * Возвращает созданные пользователем виртуальные криптокошельки.
     *
     * @return \Illuminate\Support\Collection
     */
    public function createdVirtualWallets()
    {
        return DB::table('user_wallets')
            ->leftJoin('currencies', 'currencies.id', '=', 'user_wallets.currency_id')
            ->where('user_id', $this->id)
            ->get();
    }

    /**
     * Сумма, инвестированная пользователем в маркетплейс
     *
     * @return mixed
     */
    public function investedToMarketplace()
    {
        return DB::table('transactions')
            ->where('user_id', $this->id)
            ->where('transaction_type_id', TransactionsTypesConsts::INVEST_TO_MARKETPLACE_TYPE_ID)
            ->whereNull('deleted_at')
            ->sum('amount_usd');
    }

    /**
     * Возвращает маркетинговый план (параметры), присвоенный пользователю.
     *
     * @return HasOne|\Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function marketingPlan(): HasOneThrough
    {
        return $this->hasOneThrough(MarketingPlan::Class, UserMarketingPlan::Class, 'user_id', 'id', 'id', 'marketing_plan_id')
            ->whereNull('user_marketing_plans.end_at')
            ->whereNull('user_marketing_plans.deleted_at');
    }

    /**
     * Возвращает активный маркетинговый план пользователя.
     *
     * @param User|null $user
     * @return HasOne
     */
    public function userMarketingPlan(): HasOne
    {
        return $this->hasOne(UserMarketingPlan::Class)
            ->where('user_id', $this->id)
            ->whereNull('deleted_at')
            ->whereNull('end_at');
    }

    /**
     * Для выборки всех маркетинговых планов пользователя (с закрытыми).
     *
     * @param User|null $user
     * @return HasOne
     */
    public function userAllMarketingPlans(): HasMany
    {
        return $this->HasMany(UserMarketingPlan::Class)
            ->whereNull('deleted_at');
    }

    /**
     * Возвращает активный маркетинговый план пользователя.
     * Клон метода userMarketingPlan(), но исходный метод не правил - проект запущен, а этот метод один из ключевых.
     *
     * @param User|null $user
     * @return HasOne
     */
    public function userMarketingPlan2(): HasOne
    {
        return $this->hasOne(UserMarketingPlan::Class, 'user_id', 'id')
            ->whereNull('deleted_at')
            ->whereNull('end_at');
    }

    /**
     * Возвращает кол-во часов, которое осталось до наступления первого срока и можно закрывать план
     *
     * @return int
     */
    public function minDurationDaysLeft(): int
    {
        $from = Carbon::parse($this->userMarketingPlan->start_at);

        return $this->marketingPlan->min_duration * 24 - Carbon::now()->diffInHours($from);
    }

    /**
     * Возвращает запись с активным маркетинг-планом пользователя
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\BelongsTo|HasOne|null|object
     */
    public function getUserMarketingPlan()
    {
        return $this->userMarketingPlan()->first();
    }

    /**
     * Возвращает отношение - баланс пользователя
     *
     * @param int $balance_type_id - id типа баланса
     * @param int $currency_id - id валюты
     * @return HasOne
     */
    public function balance(int $balance_type_id, int $currency_id = 1): HasOne
    {
        return $this->hasOne(Balance::Class)
            ->where('user_id', $this->id)
            ->where('balance_type_id', $balance_type_id)
            ->where('currency_id', $currency_id);
    }

    /**
     * Возвращает баланс пользователя
     *
     * @param int $balance_type_id - id типа баланса
     * @param int $currency_id - id валюты
     * @return HasOne
     */
    public function getBalance(int $balance_type_id, int $currency_id = 1): float
    {
        $balance = $this->balance($balance_type_id, $currency_id)->get();

        return is_null($balance->first()) ? 0 : $balance->first()->balance;
    }

    /**
     * Возвращает сумму, инвестированную в коин
     *
     * @return float
     */
    public function investToCoin(): float
    {
        return $this->getBalance(BalanceTypeConstants::INVEST_TO_COIN);
    }

    /**
     * Возвращает допустимую для инвестирования в маркетинг-план сумму.
     *
     * @return mixed
     */
    public function availableSumToInvestInMarketing()
    {
        return $this->balance_usd + $this->getBalance(BalanceTypeConstants::INVEST_TO_COIN, CurrencyConstants::USD);
    }

    /**
     * Возвращает кол-во дней с момента последнего вывода.
     *   Если выводов небыло — с момента начала работы последнего плана.
     *   Если планов небыло — 30 (т.е. если только завел и поставил на вывод)
     *
     * @return int
     */
    public function lastWithdrawalDaysAgo(): int
    {
        // Находим последнюю транзакцию вывода
        $from = Transaction::where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_TYPE_ID)
            ->where('user_id', $this->id)
            ->orderBy('id', 'desc')
            ->first();

        // Если выводов не было
        if (is_null($from)) {
            // Берем последний маркетинговый план пользователя
            $lastUserMarketingPlan = UserMarketingPlan::where('user_id', $this->id)
                ->whereNull('deleted_at')
                ->orderBy('id', 'desc')
                ->first();
            // Если небыло маркетинговых планов
            if (is_null($lastUserMarketingPlan)) {
                return 30;
            } else { // Если были (или есть) маркетинговые планы - дата начала последнего
                $from = $lastUserMarketingPlan;
            }
        }
        $to = Carbon::now();

        return $to->diffInDays(Carbon::parse($from->created_at));
    }

    /**
     * Возвращает комиссию вывода
     *
     * @return float
     */
    public function getCommissionForWithdrawal(): float
    {
        $lastWithdrawalDaysAgo = $this->lastWithdrawalDaysAgo();

        return ($lastWithdrawalDaysAgo < 30) ? (30 - $lastWithdrawalDaysAgo) * config('finance.first_day_commission') / 30 : 0;
    }

    /**
     * Возвращает отношение - пригласившего пользователя
     *
     * @param
     * @param
     * @return HasOne
     */
    public function parentUser()
    {
        return User::where('id',$this->parent_id)->first();
    }
    /**
     * Возвращает все маркетинговые планы пользователя.
     *
     * @param User|null $user
     * @return HasOne
     */
    public function userMarketingPlans(): HasMany
    {
        return $this->HasMany(UserMarketingPlan::Class)
            ->where('user_id', $this->id)
            ->whereNull('deleted_at')
            ->whereNull('end_at');
    }
    /**
     * Возвращает все активные маркетинговые планы пользователя.
     *
     * @param User|null $user
     * @return HasOne
     */
    public function userActiveMarketingPlans(): HasMany
    {
        return $this->HasMany(UserMarketingPlan::Class);
    }

    /**
     * @return array
     */
    public function getAllLevelsParent() : array
    {
        $user = $this;
        $k = 0.17;
        $users = array();
        for ($i=0; $i<7; $i++) {
            if (is_null($user->parent_id)) {
                break;
            }
            $users[] = ["id" => $user->parent_id,"key" => $k*100];
            if ($user->parent_id == 1) {
                break;
            } else {
                $user = $user->parentUser();
                $k *= 0.17;
            }
        }
        return $users;
    }

    public function getAllParents() : array
    {
        $user = $this;
        $users = [];

        $referralLevels = config('referral_levels');

        for($i=1; $i<=5; $i++) {
            if (!is_null($user->parent_id)) {
                $user = $user->parentUser();

                $percent = ($user->invested_usd >= 1000) ?
                    $referralLevels['high_invest'][$i] ?? 0 :
                    $referralLevels['low_invest'][$i] ?? 0;

                $users[] = [
                    "id" => $user->id,
                    "key" => $percent * 100
                ];

                if ($user->id == 1 or is_null($user->parent_id)) {
                    break;
                }
            }
        }
        return $users;
    }

    /**
     * @return HasMany
     */
    public function refferrals()
    {
        return $this->hasMany('App\Models\User','parent_id','id');
    }

    /**
     * @return string
     */
    public function getPrettyPhone(): ? string
    {
        $phone = $this->phone;

        if (!$phone) {
            return null;
        }

        $phone = str_replace([' ', '(', ')', '-'], '', $phone);

        return $phone;
    }

    public function refferralsLastMonth()
    {
        return $this->hasMany('App\Models\User','parent_id','id')->whereMonth(
            'created_at', '=', Carbon::now()->subMonth()->month
        );
    }

    public function refferralsThisMonth()
    {
        return $this->hasMany('App\Models\User','parent_id','id')->whereMonth(
            'created_at', '=', Carbon::now()->month
        );
    }

    public function refferralsRecursive()
    {
       return $this->refferrals()->with('refferralsRecursive');
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getDepthData($level = null): array
    {
        $user = self::withDepth()->find($this->id);
        $absolute_level = $user->depth + ($level ?? 20);
        $items = $this->descendants()
            ->withDepth()
            ->having('depth', '<=', $absolute_level)
            ->pluck('depth', 'id');

        $items = $items->toArray();

        foreach ($items as $userId => &$depth) {
            $depth -= $user->depth;
        }

        return [
            'maxDepth' => $items ? max($items) : 0,
            'all' => $items,
            'filtered' => $level ? array_filter($items, function ($depth) use ($level) {
                return $depth <= $level;
            }) : $items,
        ];
    }

    public function marketingPlanPartner()
    {
        if (!Auth::user()) {
            return null;
        }

        return $this->hasMany('App\Models\Home\MarketingPlanPartner','user_id','id')
            ->where('partner_id', Auth::user()->id);
    }

    public function allmarketingPlanPartnerToUsd()
    {
        if (!Auth::user()) {
            return [];
        }

//        $marketingPlans = $this->hasMany('App\Models\Home\MarketingPlanPartner','user_id','id')
//            ->where('partner_id', Auth::user()->id)
//            ->get();

        $marketingPlans = $this->userMarketingPlans;

        $usdProfit = 0;
        $usdInvested = 0;

        foreach ($marketingPlans as $value) {

//            if ($value->invested_btc > 0) {
//                $usdProfit += $value->profit*$value->rate;
//                $usdInvested += $value->invested_btc*$value->rate;
//            } else if ($value->invested_eth > 0) {
//                $usdProfit += $value->profit*$value->rate;
//                $usdInvested += $value->invested_eth*$value->rate;
//            } else if ($value->invested_pzm > 0) {
//                $usdProfit += $value->profit*$value->rate;
//                $usdInvested += $value->invested_pzm*$value->rate;
//            } else {
//                $usdProfit += $value->profit;
//                $usdInvested += $value->invested_usd;
//            }

            if ($value->invested_btc > 0) {
                $usdProfit += $value->profit_btc * $value->rate;
                $usdInvested += $value->invested_btc * $value->rate;
            } else if ($value->invested_eth > 0) {
                $usdProfit += $value->profit_eth * $value->rate;
                $usdInvested += $value->invested_eth * $value->rate;
            } else if ($value->invested_pzm > 0) {
                $usdProfit += $value->profit_pzm * $value->rate;
                $usdInvested += $value->invested_pzm * $value->rate;
            } else {
                $usdProfit += $value->profit_usd;
                $usdInvested += $value->invested_usd;
            }
        }

        $data = [
            'profit'=>$usdProfit,
            'invested'=>$usdInvested,
        ];

        return $data;
    }

    public function recursiveRefferalsCount()
    {
        $cacheKey = 'user_recursiveRefferalsCount_' . $this->id;

        if (\Cache::has($cacheKey)) {
            return \Cache::get($cacheKey);
        }

        $sum = 0;

        foreach ($this->refferrals as $child) {
            $sum += $child->recursiveRefferalsCount();
        }

        $count = $this->refferrals->count() + $sum;

        \Cache::set($cacheKey, $count, 300);

        return $count;
    }

    public function recursiveRefferalsCountLastMonth()
    {
        $cacheKey = 'user_recursiveRefferalsCountLastMonth_' . $this->id;

        if (\Cache::has($cacheKey)) {
            return \Cache::get($cacheKey);
        }

        $sum = 0;

        foreach ($this->refferralsLastMonth as $child) {
            $sum += $child->recursiveRefferalsCountLastMonth();
        }

        $count = $this->refferrals->count() + $sum;

        \Cache::set($cacheKey, $count, 300);

        return $count;
    }

    public function recursiveRefferalsCountThisMonth()
    {
        $cacheKey = 'user_recursiveRefferalsCountThisMonth_' . $this->id;

        if (\Cache::has($cacheKey)) {
            return \Cache::get($cacheKey);
        }

        $sum = 0;

        foreach ($this->refferralsThisMonth as $child) {
            $sum += $child->recursiveRefferalsCountThisMonth();
        }

        $count = $this->refferrals->count() + $sum;

        \Cache::set($cacheKey, $count, 300);

        return $count;
    }

    public function getReplenishmentInterval($from, $to)
    {
        return $this->hasMany('App\Models\Home\Transaction')
            ->whereIn('transaction_type_id', [
                TransactionsTypesConsts::INVEST_TYPE_ID,
                TransactionsTypesConsts::ACCRUED_THROUGH_ADMIN
            ])
            ->whereBetween('created_at', [$from, $to])
            ->sum('amount_usd');
    }

    public function allReplenishment()
    {
        return $this->hasMany('App\Models\Home\Transaction')
            ->whereIn('transaction_type_id', [
                TransactionsTypesConsts::INVEST_TYPE_ID,
                TransactionsTypesConsts::ACCRUED_THROUGH_ADMIN
            ])
            ->sum('amount_usd');
    }

    public function allWithdrawal()
    {
        return $this->hasMany('App\Models\Home\Transaction')
            ->where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_TYPE_ID)
            ->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));
    }

    public function getCurrencyeUsd($currency)
    {
        $url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=' . strtolower($currency);
        $data = @file_get_contents($url);
        $priceInfo = json_decode($data);

        return $priceInfo[0]->current_price ?? 0;
    }

    public function getAllBalanceUsd(){
        return Auth()->user()->balance_usd + (Auth()->user()->balance_btc*$this->getCurrencyeUsd('BITCOIN')) + (Auth()->user()->balance_eth*$this->getCurrencyeUsd('ETHEREUM')) + (Auth()->user()->balance_pzm*$this->getCurrencyeUsd('PRIZM'));
    }

    /**
     * ПРИБЫЛЬ ОТ ИНВЕСТИЦИЙ
     *
     * @return mixed|null
     */
    public function investmentProfitUsd()
    {
//        if (!Auth::user()) {
//            return null;
//        }

        return $this->hasMany('App\Models\Home\Transaction')
            ->where('transaction_type_id', TransactionsTypesConsts::PROFIT_TYPE_ID)
            ->where('user_id', Auth()->user()->id)
            ->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));
    }

    public function userProfitPartners()
    {
        return $this->hasMany('App\Models\Home\Transaction')
            ->where('transaction_type_id', TransactionsTypesConsts::PROFIT_FROM_PARTNER_PROGRAM)
            ->sum('amount_usd');
    }

    public function bonusCareer()
    {
        return $this->hasMany('App\Models\Home\Transaction')
            ->whereIn('transaction_type_id', [TransactionsTypesConsts::BONUSES_TYPE_ID, TransactionsTypesConsts::SERVICES_REFERRAL_BONUS])
            ->sum('amount_usd');
    }

    public function investmentProfitCryptosUsd(){
        $usd = 0;
        $criptoInvestments =  $this->hasMany(UserMarketingPlan::Class)
            ->where('invested_btc', '>', 0)
            ->orWhere('invested_eth', '>', 0)
            ->orWhere('invested_pzm', '>', 0)
            ->get();
        foreach ($criptoInvestments as $value) {
            if ($value->invested_btc > 0) {
                $usd += $value->profit_btc*$value->rate;
            }
            if ($value->invested_eth > 0) {
                $usd += $value->profit_eth*$value->rate;
            }
            if ($value->invested_pzm > 0) {
                $usd += $value->profit_pzm*$value->rate;
            }
        }
        return $usd;
    }

    public function userPartnersMatchingBonuses(){
        return Transaction::whereIn('user_id', $this->refferrals()->pluck('id')->toArray())->where('transaction_type_id', TransactionsTypesConsts::MATCHING_BONUS)->sum('amount_usd');
    }

    public function sinceLastMonth($newNumber, $lastNumber){
        $value = 0;
        if (is_null($newNumber)) {
            $newNumber = 0;
        }
        if (is_null($lastNumber)) {
            $lastNumber = 0;
        }
        if ($newNumber > $lastNumber) {
            if ($lastNumber == 0) {
                return $value = 100;
            }
            $value = $newNumber-$lastNumber;
            $value = $value/$lastNumber*100;
            $value = number_format($value, 2);
        }
        return $value;
    }

    public function sinceDeposit(){
        $transactionsLastMonth =  Transaction::where('user_id', Auth()->user()->id)->whereIn('transaction_type_id', [TransactionsTypesConsts::INVEST_TYPE_ID, TransactionsTypesConsts::ACCRUED_THROUGH_ADMIN])->whereMonth(
            'created_at', '=', Carbon::now()->subMonth()->month
        )->sum('amount_usd');

        $transactionsThisMonth =  Transaction::where('user_id', Auth()->user()->id)->whereIn('transaction_type_id', [TransactionsTypesConsts::INVEST_TYPE_ID, TransactionsTypesConsts::ACCRUED_THROUGH_ADMIN])->whereMonth(
            'created_at', '=', Carbon::now()->month
        )->sum('amount_usd');

        return $this->sinceLastMonth($transactionsThisMonth, $transactionsLastMonth);
    }

    public function sinceInvested(){
        $transactionsLastMonth =  Transaction::where('user_id', Auth()->user()->id)->where('transaction_type_id', TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE)->whereMonth(
            'created_at', '=', Carbon::now()->subMonth()->month
        )->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));
        $transactionsThisMonth =  Transaction::where('user_id', Auth()->user()->id)->where('transaction_type_id', TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE)->whereMonth(
            'created_at', '=', Carbon::now()->month
        )->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));

        return $this->sinceLastMonth(-$transactionsThisMonth, -$transactionsLastMonth);
    }

    public function sinceWithdrawal(){
        $transactionsLastMonth =  Transaction::where('user_id', Auth()->user()->id)->where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_TYPE_ID)->whereMonth(
            'created_at', '=', Carbon::now()->subMonth()->month
        )->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));
        $transactionsThisMonth =  Transaction::where('user_id', Auth()->user()->id)->where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_TYPE_ID)->whereMonth(
            'created_at', '=', Carbon::now()->month
        )->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));

        return $this->sinceLastMonth(-$transactionsThisMonth, -$transactionsLastMonth);
    }

    public function sinceProfitInvestment(){
        $transactionsLastMonth =  Transaction::where('user_id', Auth()->user()->id)->where('transaction_type_id', TransactionsTypesConsts::PROFIT_TYPE_ID)->whereMonth(
            'created_at', '=', Carbon::now()->subMonth()->month
        )->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));
        $transactionsThisMonth =  Transaction::where('user_id', Auth()->user()->id)->where('transaction_type_id', TransactionsTypesConsts::PROFIT_TYPE_ID)->whereMonth(
            'created_at', '=', Carbon::now()->month
        )->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));

        return $this->sinceLastMonth($transactionsThisMonth, $transactionsLastMonth);
    }

    public function sinceProfitFromPartner(){
        $transactionsLastMonth =  Transaction::where('user_id', Auth()->user()->id)->where('transaction_type_id', TransactionsTypesConsts::PROFIT_FROM_PARTNER_PROGRAM)->whereMonth(
            'created_at', '=', Carbon::now()->subMonth()->month
        )->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));
        $transactionsThisMonth =  Transaction::where('user_id', Auth()->user()->id)->where('transaction_type_id', TransactionsTypesConsts::PROFIT_FROM_PARTNER_PROGRAM)->whereMonth(
            'created_at', '=', Carbon::now()->month
        )->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));

        return $this->sinceLastMonth($transactionsThisMonth, $transactionsLastMonth);
    }

    public function sincePartners(){
        $thisMonth = Auth()->user()->recursiveRefferalsCountThisMonth();
        $lastMonth = Auth()->user()->recursiveRefferalsCountLastMonth();

        if ($thisMonth > $lastMonth) {
            return $thisMonth-$lastMonth;
        }else {
            return 0;
        }

    }

    public function sinceTeamTurnoverFirstLevel(){

        $cacheKey = 'user_sinceTeamTurnoverFirstLevel_' . $this->id;

        if (\Cache::has($cacheKey)) {
            return \Cache::get($cacheKey);
        }

        $transactionsLastMonth =  Transaction::whereIn('user_id', Auth()->user()->refferrals->pluck('id')->toArray())->where('transaction_type_id', TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE)->whereMonth(
            'created_at', '=', Carbon::now()->subMonth()->month
        )->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));
        $transactionsThisMonth =  Transaction::whereIn('user_id', Auth()->user()->refferrals->pluck('id')->toArray())->where('transaction_type_id', TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE)->whereMonth(
            'created_at', '=', Carbon::now()->month
        )->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));
        $result = $this->sinceLastMonth(-$transactionsThisMonth, -$transactionsLastMonth);

        \Cache::set($cacheKey, $result, 300);

        return $result;
    }

    public function sinceTeamTurnover(){
        $cacheKey = 'user_sinceTeamTurnover_' . $this->id;

        if (\Cache::has($cacheKey)) {
            return \Cache::get($cacheKey);
        }

        $ids = [];
        $this->allRefferralsIds(Auth()->user(), $ids);
        $ids = array_values(array_filter($ids));

        $transactionsLastMonth =  Transaction::whereIn('user_id', $ids)->where('transaction_type_id', TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE)->whereMonth(
            'created_at', '=', Carbon::now()->subMonth()->month
        )->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));

        $transactionsThisMonth =  Transaction::whereIn('user_id', $ids)->where('transaction_type_id', TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE)->whereMonth(
            'created_at', '=', Carbon::now()->month
        )->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));
        $result = $this->sinceLastMonth(-$transactionsThisMonth, -$transactionsLastMonth);

        \Cache::set($cacheKey, $result, 300);

        return $result;
    }

    public function teamTurnoverForChart(){
        $ids = [];
        $this->allRefferralsIds(Auth()->user(), $ids);
        $ids = array_values(array_filter($ids));

        $all = Transaction::whereIn('user_id', $ids)->where('transaction_type_id', TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE)->get(['created_at', 'amount_usd' ,'amount_crypto']);

        $months = $all->groupBy(function($d) {
             return Carbon::parse($d->created_at)->format('M');
         });

        $weeks = $all->groupBy(function($d) {
             return Carbon::parse($d->created_at)->format('W');
         });

        return [
            'months' => $months,
            'weeks'  => $weeks
        ];
    }

    public function allRefferralsIds( $refferrals, &$ids = [] )
    {
        if ($refferrals->id != Auth()->user()->id) {
            $ids[] =  $refferrals->id;
        }
        foreach( $refferrals->refferralsRecursive as $child ) {
            $ids[] =  $this->allRefferralsIds( $child, $ids  );
        }
    }

    public function getMatchingBonusPercent()
    {
        if (isset($this->userBonus) && intval($this->userBonus->matching_bonus) > 0) {
            return floatval($this->userBonus->matching_bonus);
        } else {
            return 0;
        }
    }

    public function userBonus()
    {
        return $this->hasOne('App\Models\Home\Bonus', 'id', 'bonus_level');
    }

    public function statusRequests()
    {
        return $this->hasMany(UserStatusRequest::class);
    }

    /**
     * Возвращает сумму закрытых пакетов
     *
     * @param array $arrayUserId
     * @return mixed
     */
    public function getSumClosedPackages(array $arrayUserId)
    {
        $closedPackages = new ClosedPackages($arrayUserId);
        return $closedPackages->getSumClosedPackagesUsers();
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
        $sumInvested = $this->invested_usd;
        // Сумма закрытых пакетов
        $sumClosedPackages = $this->getSumClosedPackages( [ $this->id ] );

        return $sumInvested - $sumClosedPackages;
    }

    /**
     * Возвращает обороты первой линии.
     *
     * @return string
     */
    public function getTurnoverOneLine()
    {
        // Сумма инвестиций рефералов первого уровня
        $sumInvested = $this->refferrals()->sum('invested_usd');

        // Если рефералы 1-го уровня покупали сервисы то суммируем сколько они на это потратили денег
        $sumServices = $this->hasMany('App\Models\Home\Transaction')
            ->where('transaction_type_id', TransactionsTypesConsts::SERVICES_REFERRAL_ONE_LINE)
            ->sum('amount_usd');

        // Суммируем пакеты которые позакрывали рефералы 1-го уровня.
        $sumClosedPackages = $this->getSumClosedPackages( $this->refferrals->getQueueableIds() );

        return $sumInvested + $sumServices - $sumClosedPackages;
    }

    /**
     * Возвращает сумму оборотв команды.
     *
     * @return mixed
     */
    public function teamTurnover()
    {
//        $cacheKey = 'user_teamTurnover_' . $this->id;
//        if (\Cache::has($cacheKey)) {
//            return \Cache::get($cacheKey);
//        }

        $ids = [];
        $this->allRefferralsIds( Auth()->user(), $ids );
        $ids = array_values( array_filter($ids) );

        // Сумма инвестиций рефералов всех уровней
        $sumInvested =  Transaction::whereIn('user_id', $ids)
            ->whereIn('transaction_type_id', [
                TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE,
                TransactionsTypesConsts::SERVICES_REFERRAL_TEAM_TURNOVER,
            ])
            ->value(DB::raw("SUM(amount_usd) + IFNULL(sum(amount_crypto),0)"));

        // Сумма закрытых пакетов рефералов всех уровней.
        $sumClosedPackages = $this->getSumClosedPackages( $ids );
//        \Cache::set($cacheKey, $sumInvested, 300);

        return abs($sumInvested) - $sumClosedPackages;
    }

    public function teamTurnoverPerMonth()
    {
        // Если сумма собственных инвестиций == 0 то и оборот == 0
        if (Auth()->user()->invested_usd <= 0) {
            return 0;
        }

//        $cacheKey = 'user_teamTurnoverPerMonth_' . $this->id;
//        if (\Cache::has($cacheKey)) {
//            return \Cache::get($cacheKey);
//        }

        $ids = [];
        $this->allRefferralsIds( Auth()->user(), $ids );
        $ids = array_values( array_filter($ids) );

        // Сумма инвестиций рефералов всех уровней
        $sumInvested = Transaction::whereIn('user_id', $ids)
            ->whereIn('transaction_type_id', [
                TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE,
//                TransactionsTypesConsts::SERVICES_REFERRAL_TEAM_TURNOVER,
            ])
            ->whereRaw("(created_at >= ? AND created_at <= ?)",
                [date('Y-m-01') . " 00:00:00", date('Y-m-d') . " 23:59:59"])
            ->value(DB::raw("abs(SUM(amount_usd)) + abs(IFNULL(sum(amount_crypto),0))"));

        // Сумма закрытых пакетов рефералов всех уровней.
        $sumClosedPackages = $this->getSumClosedPackages( $ids );

        // id-шники рефераллов первого уровня
        $oneLineReferralIds = User::on()
            ->where('parent_id', Auth::user()->id)
            ->get()
            ->pluck('id')
            ->toArray();

        $oneLineReferralSum = Transaction::whereIn('user_id', $oneLineReferralIds)
            ->whereIn('transaction_type_id', [
                TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE,
//                TransactionsTypesConsts::SERVICES_REFERRAL_TEAM_TURNOVER,
            ])
            ->whereRaw("(created_at >= ? AND created_at <= ?)",
                [date('Y-m-01') . " 00:00:00", date('Y-m-d') . " 23:59:59"])
            ->value(DB::raw("abs(SUM(amount_usd)) + abs(IFNULL(sum(amount_crypto),0))"));


        $calcSumInvested = ( ! is_null($sumInvested) ? abs($sumInvested) : 0) -
            ( ! is_null($sumClosedPackages) ? abs($sumClosedPackages) : 0 ) -
            ( ! is_null($oneLineReferralSum) ? abs($oneLineReferralSum) : 0 );

//        \Cache::set($cacheKey, $calcSumInvested, 300);

        return (-1) * $calcSumInvested;
    }

    public function likedSuggestions() : belongsToMany
    {
        return $this->belongsToMany(
            Suggestion::class,
            'suggestion_likes',
            'user_id',
            'suggestion_id'
        );
    }
}
