<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Home\Transaction
 *
 * @property int $id
 * @property int $user_id id пользователя-владельца транзакции.
 * @property int $transaction_type_id id типа транзакции.
 * @property int|null $wallet_id id кошелька, участвующего в транзакции.
 * @property float|null $amount_crypto Суммма операции в валюте currency_id.
 * @property float $amount_usd Сумма операции в usd по курсу rate.
 * @property float $amount_eth
 * @property float $amount_btc
 * @property float $amount_pzm
 * @property float|null $rate Курс операции (валюты currency_id к rate).
 * @property float $commission Комиссия операции (сумма операции указана без комиссии).
 * @property float $balance_usd_after_transaction Баланс пользователя после выполнения данной транзакции.
 * @property float $balance_eth_after_transaction
 * @property float $balance_btc_after_transaction
 * @property float $balance_pzm_after_transaction
 * @property float|null $percent Процент транзакции (начисления, комиссии и т.п.)
 * @property float|null $percent_on_amount От какой суммы брался процент.
 * @property int|null $line_number В транзакциях прибылях от партнеров - хранение линии с которой был доход
 * @property string|null $end_period Дата до которой нельзя выводить средства (т.е. до которой средства не доступны).
 * @property int|null $related_user_id id, связанного с транзакций пользователя.
 * @property int|null $related_user_wallet_id Связанный виртуальный криптокошелек.
 * @property int|null $editor_id id пользователя, выполнившего правки.
 * @property int|null $currency_id
 * @property string|null $comment
 * @property int $manual Транзакция создана вручную.
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Home\Currency|null $currency
 * @property-read \App\Models\User|null $editorUser
 * @property-read \App\Models\User|null $relatedUser
 * @property-read \App\Models\Home\TransactionType $transactionType
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Home\Wallet|null $wallet
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction activeUser()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Transaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction realAndNotDeletedUsers($start, $end, $transaction_types)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereAmountBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereAmountCrypto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereAmountEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereAmountPzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereAmountUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereBalanceBtcAfterTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereBalanceEthAfterTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereBalancePzmAfterTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereBalanceUsdAfterTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereEditorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereEndPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereLineNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereManual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction wherePercentOnAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereRelatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereRelatedUserWalletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereTransactionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereWalletId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Transaction withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Transaction withoutTrashed()
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'transaction_type_id',
        'amount_crypto',
        'amount_usd',
        'rate',
        'end_period',
        'commission',
        'percent',
        'percent_on_amount',
        'balance_usd_after_transaction',
        'related_user_id',
        'comment',
        'manual',
        'wallet_id',
        'related_user_wallet_id',
        'line_number',
        'amount_eth',
        'amount_btc',
        'balance_eth_after_transaction',
        'balance_btc_after_transaction',
        'currency_id',
        'deleted_at',
        'amount_pzm',
        'balance_pzm_after_transaction'
    ,
    ];

    protected $dates = ['deleted_at'];

    //******************************************************************************************************************
    // Relations
    //******************************************************************************************************************

    /**
     * Возвращает пользователя, чья данная транзакция.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function currency()
    {
        return $this->belongsTo('App\Models\Home\Currency', 'currency_id', 'id');
    }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transactionType()
    {
        return $this->belongsTo('App\Models\Home\TransactionType');
    }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wallet()
    {
        return $this->belongsTo('App\Models\Home\Wallet', 'wallet_id', 'id');
    }

    /**
     * Пользователь, связанный с транзакцией
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relatedUser()
    {
        return $this->belongsTo('App\Models\User', 'related_user_id');
    }

    //******************************************************************************************************************
    // Scopes
    //******************************************************************************************************************
    /**
     * Scope a query to only current active user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeActiveUser($query): Builder
    {
        return $query->where('user_id', Auth()->user()->id);
    }

    /*
     * Транзакции только реальных и не удаленных пользователей.
     *
     */
    public function scopeRealAndNotDeletedUsers($query, $start, $end, $transaction_types)
    {
        return $query->leftjoin('users', function ($join) {
            $join->on('users.id', '=', 'transactions.user_id');
        })
            ->where('users.fake', 0)
            ->whereRaw('date(transactions.created_at) >= ?', [$start])
            ->whereRaw('date(transactions.created_at) <= ?', [$end])
            ->whereIn('transactions.transaction_type_id', $transaction_types)
            ->whereNull('users.deleted_at')
            ->select(['transactions.created_at', 'transactions.amount_usd', 'users.email', 'users.phone'])
            ->orderBy('transactions.id', 'desc');
    }

    //******************************************************************************************************************
    // Методы данных
    //******************************************************************************************************************

    /**
     * Возвращает все транзакции
     *
     * @return mixed
     */
    public function getTransactions(): Collection
    {
        return $this->get();
    }

    /**
     * Возвращает все транзакции текущего (авторизированного) пользователя
     *
     * @return mixed
     */
    public static function getActiveUserTransactions(): Collection
    {
        return Transaction::activeUser()->orderByDesc('id')->get();
    }

    public function editorUser()
    {
        return $this->belongsTo('App\Models\User', 'editor_id');
    }
}
