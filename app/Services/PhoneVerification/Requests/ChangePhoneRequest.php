<?php

namespace App\Services\PhoneVerification\Requests;

use App\Rules\PhoneRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ChangePhoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone'   => [
                'required',
                new PhoneRule(),
                Rule::unique('users', 'phone')
                    ->ignore(auth()->user()->id)
            ],
            'code'   => ['required'],
        ];
    }
}
