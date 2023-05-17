<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Home\Ipn
 *
 * @property int $id
 * @property int $wallet_id id кошелька, участвующего в транзакции.
 * @property string $address Кошелек, на который были переведены средства.
 * @property string|null $dest_tag
 * @property float $amount Сумма в криптовалюте.
 * @property int $confirms Количество подтверждений.
 * @property string $currency Обозначение криптовалюты.
 * @property float $fiat_amount Сумма в фиатных деньгах по курсу.
 * @property string $fiat_coin Обозначение фиатных денег.
 * @property string $ipn_id id IPN
 * @property string $merchant id merchant
 * @property int $status Статус транзакции.
 * @property string $status_text Текст статуса транзакции.
 * @property string $txn_id Хэш транзакции.
 * @property string $request_data Весь post-запрос.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereConfirms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereDestTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereFiatAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereFiatCoin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereIpnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereMerchant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereRequestData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereStatusText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereTxnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereWalletId($value)
 * @mixin \Eloquent
 */
class Ipn extends Model
{
    protected $fillable = [
        'wallet_id', 'address', 'dest_tag', 'amount', 'confirms', 'currency', 'fiat_amount', 'fiat_coin', 'ipn_id', 'merchant',
        'status', 'status_text', 'txn_id', 'request_data'
    ];

    public function getWallet()
    {

        return Wallet::where('currency_id', $this->currency()->id)
            ->where('address', $this->address)
            ->where('additional_data', $this->additional_data)
            ->first();
    }
}
