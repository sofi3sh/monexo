<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Home\UserPaymentDetail
 *
 * @property int $id
 * @property int $user_id id пользователя
 * @property int $currency_id id криптовалюты (по факту - платежной системы)
 * @property string $address Адрес кошелька (по факту - реквизиты плат. сист.)
 * @property string|null $additional_data Дополнительные данные плат. сист.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $transaction_id id транзакции
 * @property-read \App\Models\Home\Currency $currency
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\UserPaymentDetail onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereAdditionalData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\UserPaymentDetail withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\UserPaymentDetail withoutTrashed()
 * @mixin \Eloquent
 */
class UserPaymentDetail extends Model
{
    // Ожидание подтверждения
    const WAITING_FOR_CONFIRMATION = 'Waiting for confirmation';

    // Незавершенная операция
    const INCOMPLETE_OPERATION = 'Incomplete operation';

    // Отклоненная операция
    const REJECTED_OPERATION = 'Rejected operation';

    // Проведенная операция
    const OPERATION_PERFORMED = 'Operation performed';

    const DATE_PAYMENT = "2021-01-26 22:16:00";

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'user_payment_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'currency_id', 'address', 'additional_data'];

    public function currency()
    {
        return $this->belongsTo('App\Models\Home\Currency');
    }

    /**
     * Из additional_data извлекает сумму и валюту конкатинирует и возвращает их.
     * Пример: "Balance replenishment#4#ETH" -> "4 ETH"
     *
     * @return string|null
     */
    public function getAmountCurrencyAttribute()
    {
        $additionalData = explode( '#', $this->additional_data, 4);
        $amount = array_key_exists(1, $additionalData) ? $additionalData[1] : null;
        $currencyCode = array_key_exists(2, $additionalData) ? $additionalData[2] : null;
        return $amount . ' ' . $currencyCode;
    }

    /**
     * Из additional_data извлекаем тип операции и переводим его на текущий язык.
     * Пример: "Balance replenishment#4#ETH" -> "Пополнение"
     *
     * @return array|string|null
     */
    public function getTypeOperationAttribute()
    {
        $typeOperation = stristr($this->additional_data, '#', true);

        $commissionPos = strpos($this->additional_data, '#commission:') + strlen('#commission:');
        $emailPos = strpos($this->additional_data, '#email:') + strlen('#email:');

        $commission = substr($this->additional_data, $commissionPos, $emailPos - $commissionPos - strlen('#email:'));
        $email = substr($this->additional_data, $emailPos);

        if($commission && $email) {
            return __('base.dash.balance.additional_data.' . $typeOperation, compact('commission', 'email'));
        } elseif($email) {
            return __('base.dash.balance.additional_data.' . $typeOperation, compact('email'));
        }

        return __('base.dash.balance.additional_data.' . $typeOperation);
    }

    /**
     * Возвращает статус операции пользователя.
     *
     * @return string
     */
    public function getAddressStatusAttribute()
    {
        switch ($this->address) {
            case 'Canceled':
                $status = 'canceled';
                break;
            case 'Confirmed':
                $status = 'confirmed';
                break;
            case '':
                $status = 'not_executed';
                break;
            default:
                $status = 'success';
        }
        return $status;
    }

    /**
     * Возвращает локализированный статус операции пользователя.
     *
     *  'not_executed' => 'Ожидание'
     *  'canceled' => 'Отменена',
     *  'confirmed' => 'Подтверждена'
     *  'success' => 'Успех'
     *
     * @return array|string|null
     */
    public function getAddressStatusLangAttribute()
    {
        return __('base.dash.balance.statuses.' . $this->getAddressStatusAttribute());
    }

    public function getButtonContinueAttribute()
    {
        return $this->getStatusOperation();

//        if ( stristr($this->additional_data, '#', true) === 'Balance replenishment' &&
//            (
//                $this->currency_id === 1 ||
//                $this->currency_id === 2 ||
//                $this->currency_id === 25 ||
//                $this->currency_id === 22
//            ) && (
//                $this->getStatusOperation() === self::INCOMPLETE_OPERATION
//            )
//        ) {
//            return 1;
//        } else {
//            return 0;
//        }
    }

    public function getStatusOperationLangAttribute()
    {
        $statusOperationLang = '';

        if ( $this->getStatusOperation() === 1 ) {
            $statusOperationLang = 'Незавершенная операция';
        }

        return $statusOperationLang;

//        $result = '';
//
//        switch ( $this->getStatusOperation() ) {
//            case self::WAITING_FOR_CONFIRMATION:
//                $result = 'Ожидание подтверждения';
//                break;
//            case self::INCOMPLETE_OPERATION:
//                $result = 'Незавершенная операция';
//                break;
//            case self::REJECTED_OPERATION:
//                $result = 'Отклоненная операция';
//                break;
//            case self::OPERATION_PERFORMED:
//                $result = 'Проведенная операция';
//                break;
//        }
//
//        return $result;
    }

    private function getStatusOperation()
    {
        $statusOperation = 0;

        if ($this->created_at >= self::DATE_PAYMENT && stristr($this->additional_data, '#', true) === 'Balance replenishment') {
            if (boolval( stripos($this->additional_data, 'USD')) ||
                boolval( stripos($this->additional_data, 'BTC')) ||
                boolval( stripos($this->additional_data, 'PZM')) ||
                boolval( stripos($this->additional_data, 'ETH')))
            {
                if ( $this->status === null ) {
                    $statusOperation = 1;
                }
            }
        }


        return $statusOperation;

//        $statusOperation = 0;
//        if ( stristr($this->additional_data, '#', true) === 'Balance replenishment' && $this->address === '' ) {
//            $statusOperation = 1;
//        }
//        return $statusOperation;



//        $result = '';
//        $typeOperation = stristr($this->additional_data, '#', true);
//
//        if ( $typeOperation !== 'Balance replenishment' ) {
//            return $result;
//        }
//
//        switch ( $this->currency_id ) {
//            case 1: // Bitcoin
//            case 2: // Prizm
//            case 25: // Ethereum
//                if ( $this->transaction_id === NULL ) {
//                    $result = self::INCOMPLETE_OPERATION; // Незавершенная операция
//                } elseif ( $this->address === NULL ) {
//                    $result = self::WAITING_FOR_CONFIRMATION; // Ожидание подтверждения
//                } elseif ( $this->address == 'Confirmed' ) {
//                    $result = self::OPERATION_PERFORMED; // Проведенная операция
//                } elseif ( $this->address == 'Canceled' ) {
//                    $result = self::REJECTED_OPERATION; // Отклоненная операция
//                }
//                break;
//            case 22: // Perfect Money
//                if ( $this->transaction_id === NULL ) {
//                    $result = self::INCOMPLETE_OPERATION; // Незавершенная операция
//                } elseif ( $this->address !== NULL ) {
//                    $result = self::OPERATION_PERFORMED; // Проведенная операция
//                }
//                break;
//        }
//
//        return $result;
    }

    public function getStatusAllOperationAttribute()
    {
//        Balance replenishment
//        Balance pay out
//        Deposit percent
//        Bonus replenishment
        $textStatusOperation = '';

        switch ( stristr($this->additional_data, '#', true) ) {
            case 'Balance replenishment':
//                Пополнение баланса
                if ( $this->address == '' && $this->transaction_id == '' ) {
                    $textStatusOperation = 'during';
                } elseif (
                    ( mb_substr($this->address, 0, 1) == '{' ) ||
                    ( $this->address == 'tt-admin' && $this->transaction_id != '' )
                ) {
                    $textStatusOperation = 'success';
                } else {
                    $textStatusOperation = 'no_data';
                }
                break;
            case 'Balance pay out':
//                Снятие средств с баланса
                switch ( $this->address ) {
                    case 'success':
                        $textStatusOperation = 'withdrawal_created';
//                        $textStatusOperation = 'success';
                        break;
                    case 'Confirmed':
                        $textStatusOperation = 'confirmed';
                        break;
                    case 'Canceled':
                        $textStatusOperation = 'canceled';
                        break;
                    case '':
                        if ($this->transaction_id != '') {
                            $textStatusOperation = 'withdrawal_created';
//                            $textStatusOperation = 'success';
                        } else {
                            $textStatusOperation = 'not_determined';
                        }
                        break;
                }
                break;
            case 'Deposit percent':
//                Депозитный процент
                $textStatusOperation = 'success';
                break;
            case 'Bonus replenishment':
//                Выплата бонуса
                $textStatusOperation = 'success';
                break;

            case 'User money transfer send':
//                Пользовательский перевод
                $textStatusOperation = 'success';
                break;

            case 'User money transfer give':
                $textStatusOperation = 'success';
                break;
            case 'buy partners map':
                $textStatusOperation = 'success';
                break;
            case 'refuse partners map':
                $textStatusOperation = 'success';
                break;
            
            case 'debt_usd_to_balance_usd':
                $textStatusOperation = 'success';
                break;
            
        }

        return __('base.dash.balance.status_operation.' . $textStatusOperation);
    }
}
