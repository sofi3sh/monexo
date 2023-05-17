<?php

namespace App\Http\Requests\Backend\Suggestion;

use Illuminate\Foundation\Http\FormRequest;

class IndexSuggestionRequest extends FormRequest
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
        if (request()->input('type_id') !== '0') {
            return [
                'type_id' => ['nullable', 'numeric', 'exists:suggestion_types,id'],
            ];
        } else {
            return [];
        }

    }
}
