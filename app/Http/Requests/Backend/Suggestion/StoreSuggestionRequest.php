<?php

namespace App\Http\Requests\Backend\Suggestion;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuggestionRequest extends FormRequest
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
            'title'   => ['nullable', 'string', 'max:128'],
            'text'   => ['required'],
            'type_id'   => ['nullable', 'exists:suggestion_types,id'],
        ];
    }

    public function messages()
    {
        return [
            'text.required'    => __('base.dash.ideas.text_required'),
        ];
    }
}
