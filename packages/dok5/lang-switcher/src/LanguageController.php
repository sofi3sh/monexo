<?php

namespace Dok5\LangSwitcher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

/**
 *
 * Class LanguageController.
 */
class LanguageController extends Controller
{
    /**
     * Обработка переключения языка
     *
     * @param $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function swap($locale)
    {
        // Если есть есть такое обозначение в массиве языков и данный язык включен для использования
        if (array_key_exists($locale, config('locale.languages')) &&
            config('locale.languages')[$locale][4]) {
            // Если пользователь вошел в систему и в модели есть поле 'locale' - записываем в базу выбранный язык
            if (Auth::check() && (Schema::hasColumn(auth()->user()->getTable(), 'locale'))) {
                auth()->user()->update(['locale' => $locale]);
            }

            session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
