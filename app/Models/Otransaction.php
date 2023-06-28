<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otransaction extends Model
{
//    use HasFactory;

    public $timestamps = true;

//    protected static $factory = Otransaction::class;
    protected $table = 'transactions';

    protected $fillable = [
        'id',
        'user_id',
        'transaction_type_id',
        'wallet_id',
        'amount_crypto',
        'amount_usd',
        'amount_eth',
        'amount_btc',
        'amount_pzm',
        'rate',
        'commission',
        'balance_usd_after_transaction',
        'balance_eth_after_transaction',
        'balance_btc_after_transaction',
        'balance_pzm_after_transaction',
        'percent', 'percent_on_amount',
        'line_number',
        'end_period', 'related_user_id',
        'related_user_wallet_id',
        'editor_id',
        'currency_id',
        'exchange_direction',
        'comment',
        'manual',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',];
}
