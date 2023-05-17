<?php

namespace Modules\Graybull\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Modules\Graybull\Models\Bet;

class CloseBet extends FormRequest
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
     */
    public function rules()
    {
        $betTableName = (new Bet)->getTable();

        return [
            'bet_id' => "bail|required|int|exists:{$betTableName},id",
        ];
    }
}
