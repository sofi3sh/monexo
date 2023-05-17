<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Home\Rate
 *
 * @property int $id
 * @property int $currency_id id валюты
 * @property float $rate Курс валюты к доллару.
 * @property float $trend % изменения курса за последние сутки.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Home\Currency $currency
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate whereTrend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Rate extends Model
{
    protected $fillable = ['currency_id', 'rate','trend'];

    /**
     * Получить валюту по курсу
     */
    public function currency()
    {
        return $this->belongsTo('App\Models\Home\Currency');
    }
}
