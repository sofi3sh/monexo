<?php

namespace Modules\Graybull\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Modules\Graybull\Models\Bet;
use Modules\Graybull\Exceptions\{ActiveBetAlreadyExistsException, InsufficientFundsException};
use Modules\Graybull\Models\BetCurrency;

class MakeBet extends FormRequest
{
    /**
     * Определить, уполномочен ли пользователь делать этот запрос
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Получить правила проверки, применяемые к запросу
     *
     * @return string[]
     * @throws ActiveBetAlreadyExistsException
     */
    public function rules()
    {
        if (Bet::active()->exists()) {
            throw new ActiveBetAlreadyExistsException;
        }

        return [
            'direction' => 'required|in:' . implode(',', Bet::ALL_DIRECTIONS),
            'amount' => 'required|integer|min:' . Bet::MIN_AMOUNT . '|max:' . Bet::MAX_AMOUNT,
            'duration' => 'required|integer|in:' . implode(',', Bet::DURATIONS),
            'balance' => 'required|string|in:' . implode(',', Bet::BALANCES),
        ];
    }

    /**
     * @inheritDoc
     * @throws InsufficientFundsException
     */
    protected function passedValidation()
    {
        $this->checkUserFunds();
    }

    /**
     * Проверить средства пользователя
     *
     * @throws InsufficientFundsException
     */
    private function checkUserFunds(): void
    {
        $validatedData = parent::validated();

        $amountWithCommission = $validatedData['amount'] + Bet::BET_OPENING_COMMISSION;

        $currencyRate = $validatedData['balance'] === 'usd'
            ? 1
            : BetCurrency::getExchangeRate($validatedData['balance']);

        $currencyAmount = $amountWithCommission / $currencyRate;

        request()->merge(['final_currency_amount' => $currencyAmount]);

        if (Auth::user()->{'balance_' . $validatedData['balance']} < $currencyAmount) {
            throw new InsufficientFundsException;
        }
    }
}
