<?php

namespace App\Http\Requests\Frontend\Auth;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'                 => ['required', 'string', 'min:2', 'max:128'],
            'surname'              => ['required', 'string', 'min:2', 'max:128'],
            'country'              => ['required', 'string', 'min:2', 'max:128'],
            'city'                 => ['required', 'string', 'min:2', 'max:128'],
            'birthday'             => ['required', 'string', 'date_format:d.m.Y'],
            //'phone'                => ['required', 'string',  new PhoneRule(), 'unique:users,phone'],
            'phone'                => ['sometimes'],
            'email'                => ['required', 'string', 'email', 'max:255', 'unique:users,email',/*'email_checker'*/],
            'password'             => ['required', 'string', 'min:6', 'confirmed'],
//            'g-recaptcha-response' => ['required','captcha'],
        ];

        // отключение капчи для локальных окружений
        if (\App::isLocal()) {
            unset($rules['g-recaptcha-response']);
        }

        return $rules;
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
