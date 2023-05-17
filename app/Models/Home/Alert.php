<?php

namespace App\Models\Home;

use App\Models\Consts\AlertType;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Home\Alert
 *
 * @property int $id
 * @property int $user_id
 * @property int $alert_id
 * @property string|null $email
 * @property float|null $amount
 * @property int|null $currency_id
 * @property int $status
 * @property
 * @property string $currency_type
 * @property int|null $marketing_plan_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Home\Currency|null $currency
 * @property-read \App\Models\Home\MarketingPlan|null $marketing_plan
 * @property-read \App\Models\Consts\AlertType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereAlertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereCurrencyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereMarketingPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereUserId($value)
 * @mixin \Eloquent
 */
class Alert extends Model
{
    use HasTranslations;

    /** @var string[] Переводимые колонки */
    public $translatable = ['add_info'];

    protected $fillable = [
        'id',
        'user_id',
        'alert_id',
        'email',
        'amount',
        'currency_id',
        'currency_type',
        'marketing_plan_id',
        'created_at',
        'updated_at',
        'add_info',
        'viewed',
    ];

    protected $appends = [
        'volume',
        'payment_system',
        'type_name',
        'add_info',
        'icon',
        'human_date'
    ];


    /**
     * Аксессор вернет отформатированную сумму с названием валюты.
     *
     * @return int|string
     */
    public function getVolumeAttribute()
    {
        if (!$this->amount) {
            return null;
        }

        $currency = strtoupper($this->currency_type);
        switch ($currency) {
            case 'USD':
            case 'PZM':
                return $currency . ' ' . number_format($this->amount, 2);
            default:
                return $currency . ' ' . $this->amount;
        }
     }

    /**
     * Вернет название платежной системы для алерта
     *
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|null
     */
    public function getPaymentSystemAttribute()
    {
        return isset($this->currency->name) ? $this->currency->name : '';
    }

    /**
     * Вернет имя типа алерта
     *
     * @return mixed
     */
    public function getTypeNameAttribute()
    {
        $alertTypeName = $this->type->alertTypeName();
        return isset($alertTypeName) ? $alertTypeName : '';
    }

    /**
     * Вернет имя типа алерта
     *
     * @return mixed
     */
    public static function getUnreadAlerts()
    {
    	return self::query()
            ->where('user_id', Auth()->user()->id)
            ->where('status', 0)
            ->count();
    }

    public function getAddInfoAttribute() {

        if($this->attributes['add_info'] === null) {
            return null;
        }

        $obj = json_decode($this->attributes['add_info']);
        $locale = Auth::user()->locale;
        return $obj->$locale;

    }

    /**
     * Связь типа многие к одному с таблицей типов алертов
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
    	return $this->belongsTo('App\Models\Consts\AlertType', 'alert_id');
    }

    /**
     * Связь многие к одному с платежной системой
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
    	return $this->belongsTo('App\Models\Home\Currency', 'currency_id');
    }

    /**
     * Связь многие к одному с таблицей плана маркетинга
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marketing_plan()
    {
        return $this->belongsTo('App\Models\Home\MarketingPlan', 'marketing_plan_id');
    }

    public function getCreatedDateHunan() {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getHumanDateAttribute() 
    {
        return $this->getCreatedDateHunan();
    }

    public function getIconAttribute() 
    {
        $alertCategories = [
            'balance'       => [
                AlertType::REPLANISHMENT_ACCOUNT,
                AlertType::WITHDRAWAL,
                AlertType::INVEST_COIN_REQUEST,
                AlertType::INVEST_COIN,
                AlertType::INVEST_COIN_REMOVE],
            'investments'   => [
                AlertType::OPENING_INVESTMENT,
                AlertType::ACCRUAL_OF_DAILY_INVESTMENT,
                AlertType::END_OF_INVESTMENT_ONE_DAY,
                AlertType::END_OF_INVESTMENT,
                AlertType::DEPOSIT_PROCENT,
                AlertType::ACCRUAL_OF_BONUSES,
                AlertType::MATCHING_BONUS],
            'partners'      => [
                AlertType::REGISTER_NEW_PARTNER,
                AlertType::ACCRUAL_OF_REFERRAL_PROFIT,
                AlertType::PARTNER_REPLENISHMENT],
            'transfers' => [
                AlertType::MONEY_TRANSFER,
            ]
        ];

        $icons = [
            'balance' => 'ni-money-coins',
            'investments' => 'ni-chart-bar-32',
            'partners' => 'ni-single-02',
            'transfers' => 'ni-send',
            'default' => 'ni-spaceship',
        ];

        $icon = 'default';

        foreach($alertCategories as $category => $array) 
        {
             
            if(in_array($this->alert_id, $array)) 
            {
                $icon = $category;
            }

        }


        return "<i class=\"ni $icons[$icon] text-blue\"></i>";
    }

    // Получить непочитанные сообщения для конкретного пользователя
    public static function getNotViewed($user_id, $limit) 
    {
        return static::where([
            'viewed' => 0,
            'user_id' => $user_id
        ])
        ->latest()
        ->limit($limit)
        ->get();
    }
    // получить количетсво всех непрочитанных сообщений
    public static function getCountNotViewed($user_id) 
    {
        return static::where([
            'viewed' => 0,
            'user_id' => $user_id
        ])->count();
    }
}
