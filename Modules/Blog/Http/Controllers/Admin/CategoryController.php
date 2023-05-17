<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Blog\Models\Category;
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
                'name' => 'slug',
                'label' => 'Уникальный семантический идентификатор',
                'type' => 'text',
                'hint' => 'Рекомендуется оставить пустым, по умолчанию будет создан автоматически из названия',
            ],
            [
                'name' => 'description',
                'label' => 'Описание',
                'type' => 'text',
            ],
            [
                'name' => 'color',
                'label' => 'Цвет',
                'type' => 'color',
                'required' => true,
            ],
        ];

        return view('admin.includes.partials.blog.form', [
            'title' => 'Создание категории',
            'action_route' => route('admin.blog.category.store'),
            'action_name' => 'Создать',
            'action_method' => 'post',
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
            'name_ru' => 'required|string|min:2|max:' . Category::MAX_NAME_LENGTH,
            'name_en' => 'required|string|min:2|max:' . Category::MAX_NAME_LENGTH,
            'slug' => 'nullable|string|min:2|max:' . Category::MAX_SLUG_LENGTH . 'unique:blog_categories,slug',
            'description' => 'nullable|string|min:2|max:' . Category::MAX_DESCRIPTION_LENGTH,
            'color' => 'required|string|regex:/^#([A-Fa-f0-9]{6})$/|max:' . Category::MAX_COLOR_LENGTH,
        ]);

        Category::create([
            'name' => [
                'ru' => $requestData['name_ru'],
                'en' => $requestData['name_en'],
            ],
            'slug' => $requestData['slug'],
            'description' => $requestData['description'],
            'color' => $requestData['color'],
        ]);

        return redirect()->route('admin.blog.index')
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
                'name' => 'slug',
                'label' => 'Уникальный семантический идентификатор',
                'type' => 'text',
                'placeholder' => $category->slug,
                'hint' => 'Рекомендуется оставить пустым, по умолчанию будет создан автоматически из названия',
            ],
            [
                'name' => 'description',
                'label' => 'Описание',
                'type' => 'text',
                'value' => $category->description,
            ],
            [
                'name' => 'color',
                'label' => 'Цвет',
                'type' => 'color',
                'value' => $category->color,
                'required' => true,
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

        return view('admin.includes.partials.blog.form', [
            'title' => 'Редактирование категории',
            'action_route' => route('admin.blog.category.update', $category->slug),
            'action_name' => 'Сохранить',
            'action_method' => 'patch',
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
            'name_ru' => 'required|string|min:2|max:' . Category::MAX_NAME_LENGTH,
            'name_en' => 'required|string|min:2|max:' . Category::MAX_NAME_LENGTH,
            'slug' => 'nullable|string|min:2|max:' . Category::MAX_SLUG_LENGTH . 'unique:blog_categories,slug,' . $category->slug,
            'description' => 'nullable|string|min:2|max:' . Category::MAX_DESCRIPTION_LENGTH,
            'color' => 'required|string|regex:/^#([A-Fa-f0-9]{6})$/|max:' . Category::MAX_COLOR_LENGTH,
        ]);

        foreach (['slug', 'description', 'color'] as &$attribute) {
        
            if ($category->{$attribute} !== $requestData[$attribute]) {
                $category->setAttribute($attribute, $requestData[$attribute]);
            }

            unset($attribute);
        }

        $category->update([
            'name' => [
                'ru' => $requestData['name_ru'],
                'en' => $requestData['name_en'],
            ]
        ]);

        $category->save();

        return redirect()->route('admin.blog.index')
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
        if ($category->posts()->exists()) {
            return redirect()->back()
                ->withErrors('Категория не может быть удалена, потому что она содержит посты, IDs: ' . $category->posts()->pluck('id')->implode(', '));
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
            ->latest('created_at')
            ->select([
                'id',
                'name',
                'slug',
                'description',
                'color',
                'created_at',
                'updated_at',
            ]);

        return DataTables::eloquent($query)
            ->addColumn('actions', function (Category $category) {
                $editButtonHtml = '<a href="' . route('admin.blog.category.edit', $category->slug) . '" class="btn btn-sm">✏️</a>';
                $deleteButtonHtml = '<form method="post" action="' . route('admin.blog.category.destroy', $category->slug) . '" onsubmit="return confirm(\'Удалить ' . $category->name . '?\');">'
                    . '<input type="hidden" name="_method" value="delete"/>'
                    . csrf_field()
                    . '<button type="submit" class="btn">🗑️</button>'
                    . '</form>';

                return new HtmlString("<div style='display: flex; align-items: center;'>{$editButtonHtml} {$deleteButtonHtml}</div>");
            })
            ->toJson();
    }
}
