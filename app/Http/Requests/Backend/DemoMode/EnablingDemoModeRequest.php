<?php

namespace App\Http\Requests\Backend\DemoMode;

use App\Models\Home\Transaction;
use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class EnablingDemoModeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'balance'          => Auth::user()->balance_usd,
            'transactionCount' => Transaction::where('user_id', Auth::user()->id)->get()->count(),
        ]);
    }

    public function rules()
    {
        if (Auth::user()->demo_mode) {
            return [];
        } else {
            return [
                'balance'          => [
                    'required',
                    Rule::in([0]),
                ],
                'transactionCount' => [
                    'required',
                    Rule::in([0]),
                ],
            ];
        }
    }

    public function messages()
    {
        return [
            // todo-y Локализация
            'balance.in'          => 'Ваш баланс не равен нулю.',
            'transactionCount.in' => 'На Вашем аккаунте уже были выполнены транзакции.',
        ];
    }
}
