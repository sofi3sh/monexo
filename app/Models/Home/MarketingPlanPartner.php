<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Home\MarketingPlanPartner
 *
 * @property int $id
 * @property int $user_id
 * @property int $partner_id
 * @property float|null $invested_usd
 * @property float $invested_eth
 * @property float $invested_btc
 * @property float $invested_pzm
 * @property float|null $profit
 * @property float $rate курс
 * @property int|null $line_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereInvestedBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereInvestedEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereInvestedPzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereInvestedUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereLineNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner wherePartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereUserId($value)
 * @mixin \Eloquent
 */
class MarketingPlanPartner extends Model
{
    //
}
