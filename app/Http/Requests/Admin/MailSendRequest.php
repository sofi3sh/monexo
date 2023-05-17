<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MailSendRequest extends FormRequest
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
            'type' => [
                'required',
                Rule::in(['referrers', 'all'])
            ],
            'title_ru' => 'required|string|min:2',
            'title_en' => 'required|string|min:2',
            'subject_ru' => 'required|string|min:2',
            'subject_en' => 'required|string|min:2',
            'content_ru' => 'required|string|min:2',
            'content_en' => 'required|string|min:2',
        ];
    }
}
