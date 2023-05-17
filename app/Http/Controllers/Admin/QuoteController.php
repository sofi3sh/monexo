<?php

namespace App\Http\Controllers\Admin;

use App\Models\Home\Quote;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\View\View;
use Illuminate\Support\HtmlString;
use Illuminate\Http\{Request, RedirectResponse, JsonResponse};

class QuoteController extends Controller
{
    /**
     * Страница
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.includes.partials.quotes');
    }

    /**
     * Форма создания
     *
     * @return View
     */
    public function create(): View
    {
        $fields = [
            [
                'name' => 'text_ru',
                'label' => 'Цитата на русском',
                'required' => true,
            ],
            [
                'name' => 'text_en',
                'label' => 'Цитата на английском',
                'required' => true,
            ],
            [
                'name' => 'author_ru',
                'label' => 'Автор на русском',
                'required' => true,
            ],
            [
                'name' => 'author_en',
                'label' => 'Автор на английском',
                'required' => true,
            ],
        ];

        return view('admin.includes.partials.crud-form', [
            'title' => 'Цитаты > Создание цитаты',
            'action_route' => route('admin.quote.store'),
            'action_name' => 'Создать',
            'action_method' => 'post',
            'route_back' => route('admin.quote.index'),
            'fields' => $fields,
        ]);
    }

    /**
     * Создать цитату
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function store(Request $request): RedirectResponse
    {
        $requestData = $request->validate([
            'text_ru' => 'bail|required|string|min:2|max:191',
            'text_en' => 'bail|required|string|min:2|max:191',
            'author_ru' => 'required|string|min:2|max:191',
            'author_en' => 'required|string|min:2|max:191',
        ]);

        Quote::create([
            'text' => [
                'ru' => $requestData['text_ru'],
                'en' => $requestData['text_en'],
            ],
            'author' => [
                'ru' => $requestData['author_ru'],
                'en' => $requestData['author_en'],
            ],
        ]);

        return redirect()->route('admin.quote.index')
            ->with('status', 'Цитата успешно создана');
    }

    /**
     * Форма редактирования
     *
     * @param Quote $quote
     * @return View
     */
    public function edit(Quote $quote): View
    {
        $fields = [
            [
                'name' => 'id',
                'label' => '#',
                'value' => $quote->id,
                'readonly' => true,
            ],
            [
                'name' => 'text_ru',
                'label' => 'Цитата на русском',
                'value' => $quote->getTranslation('text', 'ru'),
                'required' => true,
            ],
            [
                'name' => 'text_en',
                'label' => 'Цитата на английском',
                'value' => $quote->getTranslation('text', 'en'),
                'required' => true,
            ],
            [
                'name' => 'author_ru',
                'label' => 'Автор на русском',
                'value' => $quote->getTranslation('author', 'ru'),
                'required' => true,
            ],
            [
                'name' => 'author_en',
                'label' => 'Автор на английском',
                'value' => $quote->getTranslation('author', 'en'),
                'required' => true,
            ],
            [
                'name' => 'created_at',
                'label' => 'Создана',
                'value' => $quote->created_at,
                'readonly' => true,
            ],
            [
                'name' => 'updated_at',
                'label' => 'Изменена',
                'value' => $quote->updated_at,
                'readonly' => true,
            ],
        ];

        return view('admin.includes.partials.crud-form', [
            'title' => 'Цитаты > Редактирование цитаты',
            'action_route' => route('admin.quote.update', $quote->id),
            'action_name' => 'Сохранить',
            'action_method' => 'patch',
            'route_back' => route('admin.quote.index'),
            'fields' => $fields,
        ]);
    }

    /**
     * Обновить цитату
     *
     * @param Quote $quote
     * @param Request $request
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function update(Quote $quote, Request $request): RedirectResponse
    {
        $requestData = $request->validate([
            'text_ru' => 'required|string|min:2|max:191',
            'text_en' => 'required|string|min:2|max:191',
            'author_ru' => 'required|string|min:2|max:191',
            'author_en' => 'required|string|min:2|max:191',
        ]);

        $quote->update([
            'text' => [
                'ru' => $requestData['text_ru'],
                'en' => $requestData['text_en'],
            ],
            'author' => [
                'ru' => $requestData['author_ru'],
                'en' => $requestData['author_en'],
            ],
        ]);

        return redirect()->route('admin.quote.index')
            ->with('status', 'Цитата успешно обновлена');
    }

    /**
     * Удалить цитату
     *
     * @param Quote $quote
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Quote $quote): RedirectResponse
    {
        $quote->delete();

        return redirect()->back()
            ->with('status', 'Цитата успешно удалена');
    }

    /**
     * Получить данные для таблицы
     *
     * @return JsonResponse
     */
    public function getTableData(): JsonResponse
    {
        $query = Quote::query()
            ->orderByDesc('updated_at')
            ->select([
                'id',
                'text',
                'author',
                'created_at',
                'updated_at',
            ]);

        return DataTables::eloquent($query)
            ->editColumn('text', function (Quote $category) {
                return $category->text;
            })
            ->editColumn('author', function (Quote $category) {
                return $category->author;
            })
            ->addColumn('actions', function (Quote $quote) {
                $editButtonHtml = '<a href="' . route('admin.quote.edit', $quote->id) . '" class="btn btn-sm">✏️</a>';
                $deleteButtonHtml = '<form method="post" action="' . route('admin.quote.destroy', $quote->id) . '" onsubmit="return confirm(\'Удалить ' . $quote->text . '?\');">'
                    . '<input type="hidden" name="_method" value="delete"/>'
                    . csrf_field()
                    . '<button type="submit" class="btn">🗑️</button>'
                    . '</form>';

                return new HtmlString("<div style='display: flex; align-items: center;'>{$editButtonHtml} {$deleteButtonHtml}</div>");
            })
            ->toJson();
    }
}
