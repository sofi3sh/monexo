<?php

namespace Modules\Graybull\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Query\Builder;
use Modules\Graybull\Services\UserService;

/**
 * @property int $id ID
 * @property int $bet_id ID ставки
 * @property string $type Тип выплаты
 * @property float $percentage Процент на момент выплаты
 * @property float $amount_usd Сумма ставки в USD
 * @property Carbon $created_at Выплата создана
 *
 * @mixin Builder|BetPayment|BetPayment[]
 */
class BetPayment extends Model
{
    const TYPE_WINNING = 'winning';
    const TYPE_CASHBACK = 'cashback';

    /** @var string[] */
    const ALL_TYPES = [
        self::TYPE_WINNING,
        self::TYPE_CASHBACK,
    ];

    const WINNING_PERCENTAGE = 25;
    const CASHBACK_PERCENTAGE = 25;

    /** @inheritDoc */
    public $timestamps = false;

    /** @inheritDoc */
    protected $table = 'graybull_bet_payments';

    /** @inheritDoc */
    protected $fillable = [
        'bet_id',
        'type',
        'percentage',
        'amount_usd',
    ];

    /** @inheritDoc */
    protected $casts = [
        'amount_usd' => 'decimal:2',
    ];

    /**
     * Создание выплаты
     *
     * @param Bet $bet
     * @see Bet::closeBet()
     * @note It's highly recommended to call in DB::transaction()
     */
    public static function createPayment(Bet $bet): void
    {
        $paymentType = self::determineType($bet);
        $paymentPercentage = self::determinePercentage($bet);
        $paymentAmount = self::calculateAmount($bet, $paymentPercentage);

        /** @var self $payment */
        $payment = $bet->payment()->create([
            'type' => $paymentType,
            'percentage' => $paymentPercentage,
            'amount_usd' => $paymentAmount,
        ]);

        UserService::payUser($bet->user, $payment);
    }

    /**
     * Определить тип выплаты
     *
     * @param Bet $bet
     * @return string
     */
    private static function determineType(Bet $bet): string
    {
        switch ($bet->status) {
            case Bet::STATUS_WIN:
                return self::TYPE_WINNING;
            case Bet::STATUS_LOSS:
                return self::TYPE_CASHBACK;
            default:
                throw new \InvalidArgumentException('Invalid bet status');
        }
    }

    /**
     * Определить процент выплаты
     *
     * @param Bet $bet
     * @return string
     */
    private static function determinePercentage(Bet $bet): string
    {
        switch ($bet->status) {
            case Bet::STATUS_WIN:
                return self::WINNING_PERCENTAGE;
            case Bet::STATUS_LOSS:
                return self::CASHBACK_PERCENTAGE;
            default:
                throw new \InvalidArgumentException('Invalid bet status');
        }
    }

    /**
     * Рассчитать сумму выплаты
     *
     * @param Bet $bet
     * @param float $paymentPercentage
     * @return float
     */
    private static function calculateAmount(Bet $bet, float $paymentPercentage): float
    {
        switch ($bet->status) {
            case Bet::STATUS_WIN:
                return $bet->amount_usd + ($bet->amount_usd * ($paymentPercentage / 100));
            case Bet::STATUS_LOSS:
                return $bet->amount_usd * ($paymentPercentage / 100);
            default:
                throw new \InvalidArgumentException('Invalid bet status');
        }
    }
}
