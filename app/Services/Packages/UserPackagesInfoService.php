<?php


namespace App\Services\Packages;

use App\Models\Home\MarketingPlan;
use App\Models\Home\UserMarketingPlan;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class UserPackagesInfoService
{
    private string $user_id;

    const PACKAGE_LIGHT     = 24;
    const PACKAGE_BUSINESS  = 18;
    const PACKAGE_MINI      = 26;
    const PACKAGE_MINI_OLD  = 22;

    public function __construct(int $user_id)
    {
        $this->user_id = $user_id;
    }

    private function getUser() : User
    {
        return User::find($this->user_id);
    }

    /*
    * Возвращает идентификаторы (id) всех рефералов пользователя
    */
    private function getReferralsId() : array
    {
        $user = $this->getUser();
        return $user->descendants->pluck('id')->toArray();
    }

    /*
    * Возвращает идентификаторы (id) всех рефералов пользователя + id пользователя
    */
    private function getUserStructureIds() : array
    {
        $ids = $this->getReferralsId();
        $ids [] = $this->getUser()->id;

        return $ids;
    }

    /*
    * Возвращает количество пакетов определенного вида, открытых у пользователя и у его рефералов
    */
    public function getActivePackagesCount(int $package_id) : int
    {
        $ids = $this->getUserStructureIds();

        return UserMarketingPlan::on()
            ->where('marketing_plan_id', $package_id)
            ->whereIn('user_id', $ids)
            ->whereNull('deleted_at')
            ->where('days_left', '>', 0)
            ->whereNull('end_at')
            ->count();
    }

    /*
    * Возвращает сумму, инвестированную пользователем и его партнерами в определенный пакет
    */
    public function getActivePackagesInvested(int $package_id) : float
    {
        $ids = $this->getUserStructureIds();

        return UserMarketingPlan::on()
            ->where('marketing_plan_id', $package_id)
            ->whereIn('user_id', $ids)
            ->whereNull('deleted_at')
            ->where('days_left', '>', 0)
            ->whereNull('end_at')
            ->sum('invested_usd');
    }

    /*
    * Возвращает сумму, выплаченную по активному пакету для юзера и его рефералов
    */
    private function getActivePackagesProfit(int $package_id) : float
    {
        $referralsId = $this->getUserStructureIds();

        return UserMarketingPlan::on()
            ->where('marketing_plan_id', $package_id)
            ->whereIn('user_id', $referralsId)
            ->whereNull('deleted_at')
            ->where('days_left', '>', 0)
            ->whereNull('end_at')
            ->sum('profit_usd');
    }

    /*
    *   Возвращает средний процент для плана
    */
    private function getMiddlePercent(int $package_id) : float
    {
        $plan = MarketingPlan::find($package_id);

        if($plan->daily_percent > 0)
        {
            return $plan->daily_percent;
        }

        if($plan->manual_percent  !== NULL)
        {
            $percents = explode(':', $plan->manual_percent);
            
            return ($percents[0] + $percents[1]) / 2;
        }

        

        return ($plan->min_profit + $plan->max_profit) / 2;
    }

    private function getMinPercent(int $package_id) : float
    {
        $plan = MarketingPlan::find($package_id);

        if($plan->daily_percent > 0)
        {
            return $plan->daily_percent;
        }

        

        return ($plan->min_profit);
    }

    /*
    *   Возвращает строку, которая рассчитывает количество начислений под конкретный пакет
    */
    private function getNumberOfCharges(int $package_id) : string
    {
        if($package_id === self::PACKAGE_LIGHT) {
            return 'days_left / 7';
        }

        return 'days_left';
    }

    /*
     * Получить сумму, которую еще предстоит выплатить по пакету (пользователь + рефералы)
    */
    private function getActivePackagesDebt(int $package_id)
    {
        $ids = $this->getUserStructureIds();
        $percent = $this->getMinPercent($package_id);
        $numberOfCharges = $this->getNumberOfCharges($package_id);
        return UserMarketingPlan::on()
            ->select(DB::raw("sum(user_marketing_plans.invested_usd / 100 * $percent * $numberOfCharges) as debt"))
            ->leftJoin('marketing_plans', 'user_marketing_plans.marketing_plan_id', '=', 'marketing_plans.id')
            ->where('user_marketing_plans.days_left', '>', 0)
            ->where('user_marketing_plans.marketing_plan_id', $package_id)
            ->whereIn('user_marketing_plans.user_id', $ids)
            ->pluck('debt')
            ->first();
    }


    /*
    * Возвращает статистическую информацию по активному пакету
    */
    private function getPackageActiveInfo(int $package_id) : array
    {
        return [
            'count' => $this->getActivePackagesCount($package_id),
            'invest' => $this->getActivePackagesInvested($package_id),
            'debt' => $this->getActivePackagesDebt($package_id),
            'profit' => $this->getActivePackagesProfit($package_id)
        ];
    }

    /*
    * Возвращает объединенную статистическую информацию по пакетам
    */
    private function uniteActivePackagesInfo(array $packages_ids) : array
    {
        $packagesInfo = [
            'count' => 0,
            'invest' => 0,
            'debt' => 0,
            'profit' => 0
        ];

        foreach ($packages_ids as $id)
        {
            $info = $this->getPackageActiveInfo($id);

            foreach ($info as $key => $value)
            {
                $packagesInfo[$key] += $value;
            }
        }

        return  $packagesInfo;
    }


    /*
     *  Получить количество открытых пакетов определенного типа за все время
     */
    public function getAllPackagesCount(int $package_id) : int
    {
        $ids = $this->getUserStructureIds();

        return UserMarketingPlan::on()
            ->where('marketing_plan_id', $package_id)
            ->whereIn('user_id', $ids)
            ->count();
    }

    /*
    * Возвращает сумму, выплаченную по пакету для юзера и его рефералов
    */
    private function getAllPackagesProfit(int $package_id) : float
    {
        $referralsId = $this->getUserStructureIds();

        return UserMarketingPlan::on()
            ->where('marketing_plan_id', $package_id)
            ->whereIn('user_id', $referralsId)
            ->sum('profit_usd');
    }

    /*
    * Возвращает сумму, инвестированную пользователем и его партнерами в определенный пакет
    */
    public function getAllPackagesInvested(int $package_id) : float
    {
        $ids = $this->getUserStructureIds();

        return UserMarketingPlan::on()
            ->where('marketing_plan_id', $package_id)
            ->whereIn('user_id', $ids)
            ->sum('invested_usd');
    }


    /*
    * Возвращает статистическую информацию по пакету (активному и не активному)
    */
    private function getPackageAllInfo(int $package_id) : array
    {
        return [
            'количество пакетов' => $this->getAllPackagesCount($package_id),
            'было инвестировано' => $this->getAllPackagesInvested($package_id),
            'сколько выплачено по пакетам' => $this->getAllPackagesProfit($package_id)
        ];
    }

    public function getMarketingPlansUsd() : Collection
    {
        return MarketingPlan::
             select('id', 'name')
             ->where('currency_type', 'usd')
            ->get();
    }


    public function getAllStatistics() : array
    {
         $plans = $this->getMarketingPlansUsd();

         $results = [];

         foreach ($plans as $plan)
         {
             if($plan->id === self::PACKAGE_MINI_OLD) {
                 $results[$plan->name . '_old'] = $this->getPackageAllInfo($plan->id);
             } else {
                 $results[$plan->name] = $this->getPackageAllInfo($plan->id);
             }

         }
         return $results;
    }


    /*
    * Возвращает информацию по всем необходимым пакетам
    */
    public function getActiveStatistics() : array
    {
        $light = $this->getPackageActiveInfo(self::PACKAGE_LIGHT);
        $business = $this->getPackageActiveInfo(self::PACKAGE_BUSINESS);
        $mini = $this->uniteActivePackagesInfo([self::PACKAGE_MINI_OLD, self::PACKAGE_MINI]);

        $packages = [
            'Light (active)' => [
                'количество пакетов'           => $light['count'],
                'было инвестировано'                => '$' . $light['invest'],
                'сколько выплачено по пакетам' => '$' . $light['profit'],
                'долг'                         => '$' . ($light['debt'] ?? 0),
            ],
            'Business (active)' => [
                'количество пакетов'           => $business['count'],
                'было инвестировано'                => '$' . $business['invest'],
                'сколько выплачено по пакетам' => '$' . $business['profit'],
                'долг'                         => '$' . ($business['debt'] ?? 0),
            ],
            'Mini (active)' => [
                'количество пакетов'           => $mini['count'],
                'было инвестировано'                => '$' . $mini['invest'],
                'сколько выплачено по пакетам' => '$' . $mini['profit'],
                'долг'                         => '$' . ($mini['debt'] ?? 0),
            ],
        ];

        return $packages;
    }

    // Возвращает информацию по всем пакетам
    public function geStatistics() : array
    {
        $results = $this->getActiveStatistics();
        return array_merge($results, $this->getAllStatistics());
    }

    // Вовзращает долг по пакетам для конкретного пользователя
    public function getAllDebt() : float
    {
        $plans =  $this->getMarketingPlansUsd();
        $debt = 0;
        
        $marketingPlanIds = [
            18,	// Business	    1.5:2.1         1.8
            22,	// Mini	        0.53:0.77       0.65
            24,	// Light	    1.3:2.1         1.7
            26,	// Mini	        0.41:0.55       0.48
            12, // Standard 50
            13, // Standard 250
            14, // Standard 500
            15, // Standard 1000
            16, // Standard 2500
            17, // Standard 5000
            23, // Standard 10000
        ];

        foreach ($plans as $plan)
        {
            if(in_array($plan->id, $marketingPlanIds)) {
                $debt += $this->getActivePackagesDebt($plan->id);
            }
        }


        return $debt;
    }
}
