<?php

namespace App\Models;

use App\Models\Home\{Transaction, Alert};
use App\Models\Consts\{TransactionsTypesConsts, AlertType};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserStatusRequest extends Model
{
    const STATUS_WAIT = 'wait';
    const STATUS_CONFIRM = 'confirm';
    const STATUS_REJECT = 'reject';

    const ALL_STATUSES = [
        self::STATUS_WAIT,
        self::STATUS_CONFIRM,
        self::STATUS_REJECT,
    ];

    /** @var int USD */
    const REGIONAL_REPRESENTATIVE_STATUS_INSTAGRAM_PRICE = 250;
    const REGIONAL_REPRESENTATIVE_STATUS_TELEGRAM_PRICE = 250;

    /** @inheritDoc */
    protected $table = 'user_status_requests';

    /** @inheritDoc */
    protected $fillable = [
        'user_id',
        'user_status_id',
        'request_status',
        'extra_data',
    ];

    /** @inheritDoc */
    protected $casts = [
        'extra_data' => 'array',
    ];

    /**
     * Подтвердить заявку
     *
     * @return $this
     * @throws \Throwable
     */
    public function confirm(): self
    {
        DB::transaction(function () {
            switch ($this->user_status_id) {
                case UserStatus::STATUS_REGIONAL_REPRESENTATIVE:
                    $this->user->update(['is_regional_representative' => 1]);

                    break;
                default:
                    throw new \Exception("Подтверждение для этого статуса (id: {$this->user_status_id}) не настроено");
            }

            $this->update(['request_status' => self::STATUS_CONFIRM]);
        });

        return $this;
    }

    /**
     * Отклонить заявку
     *
     * @return $this
     * @throws \Throwable
     */
    public function reject(): self
    {
        switch ($this->user_status_id) {
            case UserStatus::STATUS_REGIONAL_REPRESENTATIVE:
                DB::transaction(function () {
                    Transaction::create(
                        [
                            'user_id' => $this->user->id,
                            'transaction_type_id' => TransactionsTypesConsts::USER_STATUS_REGIONAL_REPRESENTATIVE_REJECTED,
                            'amount_usd' => $this->extra_data['price'],
                            'balance_usd_after_transaction' => $this->user->balance_usd + $this->extra_data['price'],
                        ]
                    );

                    Alert::create([
                        'user_id' => $this->user->id,
                        'alert_id' => AlertType::USER_STATUS_REGIONAL_REPRESENTATIVE_REJECTED,
                        'amount' => $this->extra_data['price'],
                        'currency_type' => 'usd',
                    ]);
                });

                break;
            default:
                throw new \Exception("Отклонение для этого статуса (id: {$this->user_status_id}) не настроено");
        }

        $this->update(['request_status' => self::STATUS_REJECT]);

        return $this;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
