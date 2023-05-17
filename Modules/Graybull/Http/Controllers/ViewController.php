<?php

namespace Modules\Graybull\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\Graybull\Services\GraybullService;

class ViewController extends Controller
{
    /**
     * Контроль открытой сделки пользователя
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            GraybullService::controlUserActiveBet();

            return $next($request);
        });
    }

    /**
     * Получить представление
     *
     * @return View
     */
    public function getView(): View
    {
        return view('graybull::app');
    }
}
