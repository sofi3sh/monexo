<?php

namespace App\Services\PhoneVerification\Requests;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class AddPhoneRequest extends FormRequest
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
            'phone'   => ['required', new PhoneRule()],
        ];
    }
}
