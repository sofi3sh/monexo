<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Home\MarketingPlanPartnerProgram
 *
 * @property int $id
 * @property int $marketing_plan_id id маркетингового плана
 * @property int $partner_program_id id партнерской программы (id: 1 - от прибыли партнеров; 2 - от инвестиции партнеров)
 * @property int $line_number Номер линии маркетингового плана
 * @property float $profit % прибыли
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram whereLineNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram whereMarketingPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram wherePartnerProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MarketingPlanPartnerProgram extends Model
{
    //
}
