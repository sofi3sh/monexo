<?php

namespace App\Models;

use App\Models\Home\UserMarketingPlan;
use Illuminate\Database\Eloquent\Model;

class ClosedPackages extends Model
{
    const STARTING_POINT_CLOSE_MARKETING_PLAN = '2021-01-16 00:00:00';

    const STANDARD = [
        12,	// Standard 50$
        13,	// Standard 250$
        14,	// Standard 500$
        15,	// Standard 1000$
        16,	// Standard 2500$
        17,	// Standard 5000$
        23, // Standard 10000$
    ];

    const LIGHT = [
        24, //	Light
    ];

    const MINI = [
        22, //	Mini
    ];

    private $arrayUserId;

    public function __construct(array $arrayUserId, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->arrayUserId = $arrayUserId;
    }

    public function getSumClosedPackagesUsers()
    {
        $sum = 0;
        foreach ($this->arrayUserId as $userId) {
            $sum += $this->getSumClosedPackages($userId);
        }
        return $sum;
    }

    private function getSumClosedPackages(int $userId)
    {
        // Посчитаем сумму закрытых пакетов
        $packagesNotStandard =  UserMarketingPlan::where('user_id', $userId)
            ->whereNotIn('marketing_plan_id', self::STANDARD)
            ->whereNotNull('end_at')
            ->where('end_at', '>=', self::STARTING_POINT_CLOSE_MARKETING_PLAN)
            ->sum('invested_usd');

        // Для пакета стандарт его сумма
        $investedPackagesStandard = UserMarketingPlan::where('user_id', $userId)
            ->whereIn('marketing_plan_id', self::STANDARD)
            ->max('invested_usd');

        $sumClosedPackage = 0;
        // Если пакет стандарт существует
        if ( $investedPackagesStandard > 0 ) {
            $endAt = UserMarketingPlan::where('user_id', $userId)
                ->where('invested_usd', $investedPackagesStandard)
                ->first()->end_at;
            // Если пакет стандарт закрыт
            if ( $endAt !== null ) {
                $sumClosedPackage = $investedPackagesStandard;
            }
        }
        return $packagesNotStandard + $sumClosedPackage;
    }
}
