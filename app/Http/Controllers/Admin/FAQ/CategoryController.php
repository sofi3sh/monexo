<?php

namespace App\Http\Controllers\Admin\FAQ;

use App\Models\Home\FAQ\Category;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\View\View;
use Illuminate\Support\HtmlString;
use Illuminate\Http\{Request, RedirectResponse, JsonResponse};

class CategoryController extends Controller
{
    /**
     * Форма создания
     *
     * @return View
     */
    public function create(): View
    {
        $fields = [
            [
                'name' => 'name_ru',
                'label' => 'Название на русском',
                'required' => true,
            ],
            [
                'name' => 'name_en',
                'label' => 'Название на английском',
                'required' => true,
            ],
            [
                'name' => 'description',
                'label' => 'Описание',
                'type' => 'text',
            ],
        ];

        return view('admin.includes.partials.crud-form', [
            'title' => 'FAQ > Создание категории',
            'action_route' => route('admin.faq.category.store'),
            'action_name' => 'Создать',
            'action_method' => 'post',
            'route_back' => route('admin.faq.index'),
            'fields' => $fields,
        ]);
    }

    /**
     * Создать категорию
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $requestData = $request->validate([
            'name_ru' => 'required|string|min:2|max:200',
            'name_en' => 'required|string|min:2|max:200',
            'description' => 'nullable|string|min:2|max:255',
        ]);

        Category::create([
            'name' => [
                'ru' => $requestData['name_ru'],
                'en' => $requestData['name_en'],
            ],
            'description' => $requestData['description'],
        ]);

        return redirect()->route('admin.faq.index')
            ->with('status', 'Категория успешно создана');
    }

    /**
     * Форма редактирования
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        $fields = [
            [
                'name' => 'id',
                'label' => '#',
                'value' => $category->id,
                'readonly' => true,
            ],
            [
                'name' => 'name_ru',
                'label' => 'Название на русском',
                'value' => $category->getTranslation('name', 'ru'),
                'required' => true,
            ],
            [
                'name' => 'name_en',
                'label' => 'Название на английском',
                'value' => $category->getTranslation('name', 'en'),
                'required' => true,
            ],
            [
                'name' => 'description',
                'label' => 'Описание',
                'type' => 'text',
                'value' => $category->description,
            ],
            [
                'name' => 'created_at',
                'label' => 'Создан',
                'value' => $category->created_at,
                'readonly' => true,
            ],
            [
                'name' => 'updated_at',
                'label' => 'Изменен',
                'value' => $category->updated_at,
                'readonly' => true,
            ],
        ];

        return view('admin.includes.partials.crud-form', [
            'title' => 'FAQ > Редактирование категории',
            'action_route' => route('admin.faq.category.update', $category->id),
            'action_name' => 'Сохранить',
            'action_method' => 'patch',
            'route_back' => route('admin.faq.index'),
            'fields' => $fields,
        ]);
    }

    /**
     * Обновить категорию
     *
     * @param Category $category
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Category $category, Request $request): RedirectResponse
    {
        $requestData = $request->validate([
            'name_ru' => 'required|string|min:2|max:200',
            'name_en' => 'required|string|min:2|max:200',
            'description' => 'nullable|string|min:2|max:255',
        ]);

        $category->update([
            'name' => [
                'ru' => $requestData['name_ru'],
                'en' => $requestData['name_en'],
            ],
            'description' => $requestData['description'],
        ]);

        return redirect()->route('admin.faq.index')
            ->with('status', 'Категория успешно обновлена');
    }

    /**
     * Удалить категорию
     *
     * @param Category $category
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category): RedirectResponse
    {
        if ($category->questions()->exists()) {
            return redirect()->back()
                ->withErrors('Категория не может быть удалена, потому что она содержит вопросы, IDs: ' . $category->questions()->pluck('id')->implode(', '));
        }

        $category->delete();

        return redirect()->back()
            ->with('status', 'Категория успешно удалена');
    }

    /**
     * Получить данные для таблицы
     *
     * @return JsonResponse
     */
    public function getTableData(): JsonResponse
    {
        $query = Category::query()
            ->orderByDesc('created_at');

        return DataTables::eloquent($query)
            ->editColumn('name', function (Category $category) {
                return $category->name;
            })
            ->addColumn('actions', function (Category $category) {
                $editButtonHtml = '<a href="' . route('admin.faq.category.edit', $category->id) . '" class="btn btn-sm">✏️</a>';
                $deleteButtonHtml = '<form method="post" action="' . route('admin.faq.category.destroy', $category->id) . '" onsubmit="return confirm(\'Удалить ' . $category->name . '?\');">'
                    . '<input type="hidden" name="_method" value="delete"/>'
                    . csrf_field()
                    . '<button type="submit" class="btn">🗑️</button>'
                    . '</form>';

                return new HtmlString("<div style='display: flex; align-items: center;'>{$editButtonHtml} {$deleteButtonHtml}</div>");
            })
            ->toJson();
    }
}
