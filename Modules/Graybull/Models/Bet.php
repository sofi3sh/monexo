<?php

namespace Modules\Graybull\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\{Model, Builder};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasOne};
use Illuminate\Support\Facades\{Cache, DB};
use Illuminate\Support\Carbon;
use Modules\Graybull\Exceptions\BetIsNotActiveException;
use Modules\Graybull\Services\GraybullService;
use Modules\Graybull\Http\Controllers\GameController;

/**
 * @property int $id ID
 * @property int $user_id ID пользователя
 * @property int $currency_id ID валюты
 * @property string $status Статус ставки
 * @property string $direction Направление курса валюты
 * @property float $amount_usd Сумма ставки в USD
 * @property float $commission_for_opening Комиссия за открытие ставки
 * @property float $exchange_rate_at_opening Начальный курс валюты
 * @property float $exchange_rate_at_closing Финальный курс валюты
 * @property Carbon $duration Продолжительность ставки
 * @property Carbon $opened_at Ставка открыта
 * @property Carbon $closing_at Ставка должна быть закрыта
 * @property Carbon|null $closed_at Ставка закрыта
 * @property-read BetPayment|null $payment Выплата
 * @property-read BetCurrency $currency Валюта
 * @property-read User $user Пользователь
 *
 * @method static Builder active()
 * @method static Builder readyToClose()
 * @method static Builder closed()
 *
 * @mixin Builder|Bet|Bet[]
 */
class Bet extends Model
{
    const STATUS_WAIT = 'wait';
    const STATUS_WIN = 'win';
    const STATUS_LOSS = 'loss';

    /** @var string[] */
    const ALL_STATUSES = [
        self::STATUS_WAIT,
        self::STATUS_WIN,
        self::STATUS_LOSS,
    ];

    const DIRECTION_UP = 'up';
    const DIRECTION_DOWN = 'down';

    /** @var string[] */
    const ALL_DIRECTIONS = [
        self::DIRECTION_UP,
        self::DIRECTION_DOWN,
    ];

    /** @var int[] Варианты продолжительности игры в минутах */
    const DURATIONS = [1, 3, 5, 15];

    /** @var string[] Балансы */
    const BALANCES = ['usd', 'btc', 'eth', 'pzm'];

    /** @var int Минимальная ставка в USD */
    const MIN_AMOUNT = 1;

    /** @var int Максимальная ставка в USD */
    const MAX_AMOUNT = 100;

    /** @var int Минимальная разница курса валюты в USD для победы */
    const MINIMUM_RATE_DIFFERANCE_TO_WIN = 3;

    /** @var float Комиссия за открытие ставки в USD */
    const BET_OPENING_COMMISSION = 0.25;

    /** @var float Реферальная награды предку за открытия ставки в USD */
    const REFERRAL_REWARD = 0.10;

    /** @inheritDoc */
    public $timestamps = false;

    /** @inheritDoc */
    protected $table = 'graybull_bets';

    protected $guarded = ['id'];

    /** @inheritDoc */
    protected $fillable = [
        'user_id',
        'currency_id',
        'status',
        'direction',
        'amount_usd',
        'amount_btc',
        'amount_eth',
        'amount_pzm',
        'commission_for_opening',
        'exchange_rate_at_opening',
        'exchange_rate_at_closing',
        'duration',
        'opened_at',
        'closing_at',
        'closed_at',
    ];

    /** @inheritDoc */
    protected $dates = [
        'opened_at',
        'closing_at',
    ];

    /** @inheritDoc */
    protected $appends = [
        'winnings_amount',
        'duration_in_minutes',
        'remaining_seconds',
    ];

    /** @inheritDoc */
    protected $casts = [
        'amount_usd' => 'integer',
        'exchange_rate_at_opening' => 'integer',
        'exchange_rate_at_closing' => 'integer',
    ];

    /**
     * Получить сумму выигрыша
     *
     * @return float|int|mixed|null
     */
    public function getWinningsAmountAttribute()
    {
        if (isset($this->attributes['amount_usd'])) {
            return $this->attributes['amount_usd'] + ($this->attributes['amount_usd'] * (BetPayment::WINNING_PERCENTAGE / 100));
        }

        return null;
    }

    /**
     * Получить продолжительность в минутах
     *
     * @return int|null
     */
    public function getDurationInMinutesAttribute()
    {
        if (isset($this->attributes['duration']) && $this->isActive()) {
            return Carbon::createFromFormat('H:i:s', $this->attributes['duration'])->minute;
        }

        return null;
    }

    /**
     * Получить оставшиеся секунды
     *
     * @return int|null
     */
    public function getRemainingSecondsAttribute()
    {
        if (isset($this->attributes['closing_at']) && $this->isActive()) {
            return Carbon::now(config('graybull.timezone'))->diffInSeconds($this->attributes['closing_at']);
        }

        return null;
    }

    /**
     * Только активные ставки
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        $query->where('status', Bet::STATUS_WAIT)
            ->whereNull('closed_at');

        return $query;
    }

    /**
     * Только ставки готовые к закрытию
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeReadyToClose(Builder $query): Builder
    {
        $query->active()
            ->where('closing_at', '<=', now(config('graybull.timezone'))->toDateTimeString());

        return $query;
    }

    /**
     * Только закрытые ставки
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeClosed(Builder $query): Builder
    {
        $query->whereNotNull('closed_at');

        return $query;
    }

    /**
     * Проверить активна ли Ставка
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status === Bet::STATUS_WAIT
            && !$this->closed_at;
    }

    /**
     * Выплата по ставке
     *
     * @return HasOne
     */
    public function payment(): HasOne
    {
        return $this->hasOne(BetPayment::class);
    }

    /**
     * Валюта ставки
     *
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(BetCurrency::class);
    }

    /**
     * Владелец ставки
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Закрыть активную ставку
     *
     * @return $this
     * @throws BetIsNotActiveException
     * @throws \Throwable
     *
     * @see GraybullService::controlUserActiveBet()
     * @see GraybullService::controlBets()
     * @see GameController::closeActiveBet()
     */
    public function closeBet(): self
    {
        /**
         * Если ставка уже закрывается в кроне,
         * или наоборот,
         * при попытке закрытия в кроне тогда когда она уже закрывается вручную
         */
        if (Cache::has($this->getCacheKeyForClosing())) {
            return $this;
        }

        Cache::put($this->getCacheKeyForClosing(), true, now(config('graybull.timezone'))->addMinute());

        if (!$this->isActive()) {
            throw new BetIsNotActiveException;
        }

        $this->exchange_rate_at_closing = BetCurrency::getBtcRate();
        $this->status = $this->determinateStatusOnClose();
        $this->closed_at = now(config('graybull.timezone'));

        DB::transaction(function () {
            $this->save();

            BetPayment::createPayment($this);
        });

        return $this;
    }

    /**
     * Определить статус ставки
     *
     * @return string
     */
    private function determinateStatusOnClose(): string
    {
        switch ($this->direction) {
            case self::DIRECTION_UP:
                return $this->exchange_rate_at_closing >= ($this->exchange_rate_at_opening + self::MINIMUM_RATE_DIFFERANCE_TO_WIN)
                    ? self::STATUS_WIN
                    : self::STATUS_LOSS;
            case self::DIRECTION_DOWN:
                return $this->exchange_rate_at_closing <= ($this->exchange_rate_at_opening - self::MINIMUM_RATE_DIFFERANCE_TO_WIN)
                    ? self::STATUS_WIN
                    : self::STATUS_LOSS;
            default:
                throw new \InvalidArgumentException('Invalid bet direction');
        }
    }

    /**
     * Получить кэш-ключ для закрытия ставки
     *
     * @return string
     */
    private function getCacheKeyForClosing(): string
    {
        return "graybull:closing_bet:{$this->id}";
    }
}
