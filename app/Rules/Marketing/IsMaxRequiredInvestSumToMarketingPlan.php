<?php

namespace App\Rules\Marketing;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Home\MarketingPlan;
use App\Models\User;

/**
 * Выполняет проверку на максимальную сумму инвестирования при покупке плана
 *
 * Class IsMaxRequiredInvestSumToMarketingPlan
 * @package App\Rules\Marketing
 */
class IsMaxRequiredInvestSumToMarketingPlan implements Rule
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var float
     */
    protected $maxInvestSum;

    /**
     * @var float
     */
    protected $investSum;



    /**
     * Create a new rule instance.
     *
     * @param int marketing_plan_id
     * @param float $invest_sum
     * @return void
     */
    public function __construct(User $user, int $marketingPlanId, float $investSum)
    {
        $this->user = $user;
        $this->maxInvestSum = MarketingPlan::find($marketingPlanId)->max_invest_sum;
        $this->investSum = $investSum;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Получаем текущий маркетинговый план пользователя
       // $userMarketingPlan = $this->user->userMarketingPlan;
       // if (is_null($userMarketingPlan)) {
            // Если нет активного маркетингового плана
            return $this->investSum <= $this->maxInvestSum;
       // } else {
       //     return ($this->investSum + $userMarketingPlan->invested_usd) <= $this->maxInvestSum;
       // }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('base_attention.invest_to_marketing.wrong_sum_max', ['max' => $this->maxInvestSum]);
    }
}
