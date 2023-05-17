<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Home\CryptocurrencyExchange
 *
 * @property int $id
 * @property string $name Название биржи
 * @property string $sub_uri Часть ссылки, обозначающая биржу для чтения курсов
 * @property int $in_arbitrage_trading Флаг, что биржа участвует в арбитражной торговле
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\CryptocurrencyExchange onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange whereInArbitrageTrading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange whereSubUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\CryptocurrencyExchange withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\CryptocurrencyExchange withoutTrashed()
 * @mixin \Eloquent
 */
class CryptocurrencyExchange extends Model
{
    use SoftDeletes;
}
