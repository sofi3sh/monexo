<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Home\Bonus
 *
 * @property int $id
 * @property int $level Уровни
 * @property float $bonus Бонус
 * @property float $personal_deposit Личный депозит
 * @property float $team_turnover Оборот 1-й линии
 * @property float $invitation_deposit Пригласительный депозит
 * @property float $matching_bonus Матчинг бонус
 * @property float $is_invitation_deposit_available Доступен ли пригласительный депозит
 * @property float $leadership_bonus Лидерский бонус
 * @property float $is_regional_representative_status_available Доступен ли статус регионального представителя
 * @property int $affiliate_magnet Партнёрский магнит
 * @property int $fast_start Быстрый старт
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereAffiliateMagnet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereFastStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereInvitationDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereMatchingBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus wherePersonalDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereTeamTurnover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bonus extends Model
{
    public static function tableData($is_active = true): array
    {
        $bonuses = [];

        foreach (self::where('is_active', '=', (int)$is_active)->get() as &$item) {
            $bonus = (float)$item->bonus ? '$' . number_format($item->bonus, 2, '.', ' ') : '-';
            $personalDeposit = (int)$item->personal_deposit ? '$' . number_format($item->personal_deposit, 0, '', ' ') : '-';
            $teamTurnover = (int)$item->team_turnover ? '$' . number_format($item->team_turnover, 0, '', ' ') : '-';
            $matchingBonus = (float)$item->matching_bonus ? $item->matching_bonus . '%' : '-';
            $leadershipBonus = (float)$item->leadership_bonus ? $item->leadership_bonus . '%' : '-';
            $isInvitationDepositAvailable = $item->is_invitation_deposit_available ? __('Yes') : '-';
            $isRegionalRepresentativeStatusAvailable = $item->is_regional_representative_status_available ? __('Yes') : '-';
            $is_active = $item->is_active;

            $bonuses[] = [
                'level' => $item->level,
                'bonus' => $bonus,
                'personal_deposit' => $personalDeposit,
                'team_turnover' => $teamTurnover,
                'matching_bonus' => $matchingBonus,
                'leadership_bonus' => $leadershipBonus,
                'is_invitation_deposit_available' => $isInvitationDepositAvailable,
                'is_regional_representative_status_available' => $isRegionalRepresentativeStatusAvailable,
                'is_active' => $is_active,
            ];

            unset($item);
        }

        return $bonuses;
    }
}
