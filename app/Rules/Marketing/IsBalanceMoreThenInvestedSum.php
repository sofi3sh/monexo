<?php

namespace App\Rules\Marketing;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

/**
 * Проверяет, не превышает ли инвестируемая сумма допустимые для использования балансы.
 *
 * Class IsBalanceMoreThenInvestedSum
 * @package App\Rules\Marketing
 */
class IsBalanceMoreThenInvestedSum implements Rule
{
    protected $investSum;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(float $investSum)
    {
        $this->investSum = $investSum;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Auth::user()->availableSumToInvestInMarketing() >= $this->investSum;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('base_attention.invest_to_marketing.wrong_sum_balance', ['balance' => Auth::user()->availableSumToInvestInMarketing()]);
    }
}
