<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Blog\Models\Tag;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\View\View;
use Illuminate\Support\HtmlString;
use Illuminate\Http\{Request, RedirectResponse, JsonResponse};

class TagController extends Controller
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
                'name' => 'name',
                'label' => 'Название',
                'required' => true,
            ],
            [
                'name' => 'slug',
                'label' => 'Уникальный семантический идентификатор',
                'type' => 'text',
                'hint' => 'Рекомендуется оставить пустым, по умолчанию будет создан автоматически из названия',
            ],
        ];

        return view('admin.includes.partials.blog.form', [
            'title' => 'Редактирование тега',
            'action_route' => route('admin.blog.tag.store'),
            'action_name' => 'Создать',
            'action_method' => 'post',
            'fields' => $fields,
        ]);
    }

    /**
     * Создать тег
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $requestData = $request->validate([
            'name' => 'required|string|min:2|max:' . Tag::MAX_NAME_LENGTH,
            'slug' => 'nullable|string|min:2|max:' . Tag::MAX_SLUG_LENGTH . 'unique:blog_tags,slug',
        ]);

        Tag::create([
            'name' => $requestData['name'],
            'slug' => $requestData['slug'],
        ]);

        return redirect()->route('admin.blog.index')
            ->with('status', 'Тег успешно создан');
    }

    /**
     * Форма редактирования
     *
     * @param Tag $tag
     * @return View
     */
    public function edit(Tag $tag): View
    {
        $fields = [
            [
                'name' => 'id',
                'label' => '#',
                'value' => $tag->id,
                'readonly' => true,
            ],
            [
                'name' => 'name',
                'label' => 'Название',
                'value' => $tag->name,
                'required' => true,
            ],
            [
                'name' => 'slug',
                'label' => 'Уникальный семантический идентификатор',
                'type' => 'text',
                'placeholder' => $tag->slug,
                'hint' => 'Рекомендуется оставить пустым, по умолчанию будет создан автоматически из названия',
            ],
            [
                'name' => 'created_at',
                'label' => 'Создан',
                'value' => $tag->created_at,
                'readonly' => true,
            ],
            [
                'name' => 'updated_at',
                'label' => 'Изменен',
                'value' => $tag->updated_at,
                'readonly' => true,
            ],
        ];

        return view('admin.includes.partials.blog.form', [
            'title' => 'Редактирование тега',
            'action_route' => route('admin.blog.tag.update', $tag->slug),
            'action_name' => 'Сохранить',
            'action_method' => 'patch',
            'fields' => $fields,
        ]);
    }

    /**
     * Обновить тег
     *
     * @param Tag $tag
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Tag $tag, Request $request): RedirectResponse
    {
        $requestData = $request->validate([
            'name' => 'required|string|min:2|max:' . Tag::MAX_NAME_LENGTH,
            'slug' => 'nullable|string|min:2|max:' . Tag::MAX_SLUG_LENGTH . 'unique:blog_tags,slug,' . $tag->slug,
        ]);

        foreach (['name', 'slug'] as &$attribute) {
            if ($tag->{$attribute} !== $requestData[$attribute]) {
                $tag->setAttribute($attribute, $requestData[$attribute]);
            }

            unset($attribute);
        }

        $tag->save();

        return redirect()->route('admin.blog.index')
            ->with('status', 'Тег успешно обновлен');
    }

    /**
     * Удалить тег
     *
     * @param Tag $tag
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();

        return redirect()->back()
            ->with('status', 'Тег успешно удален');
    }

    /**
     * Получить данные для таблицы
     *
     * @return JsonResponse
     */
    public function getTableData(): JsonResponse
    {
        $query = Tag::query()
            ->latest('created_at')
            ->select([
                'id',
                'name',
                'slug',
                'created_at',
                'updated_at',
            ]);

        return DataTables::eloquent($query)
            ->addColumn('actions', function (Tag $tag) {
                $editButtonHtml = '<a href="' . route('admin.blog.tag.edit', $tag->slug) . '" class="btn btn-sm">✏️</a>';
                $deleteButtonHtml = '<form method="post" action="' . route('admin.blog.tag.destroy', $tag->slug) . '" onsubmit="return confirm(\'Удалить ' . $tag->name . '? (При удалении тега, он будет удален из постов)\');">'
                    . '<input type="hidden" name="_method" value="delete"/>'
                    . csrf_field()
                    . '<button type="submit" class="btn">🗑️</button>'
                    . '</form>';

                return new HtmlString("<div style='display: flex; align-items: center;'>{$editButtonHtml} {$deleteButtonHtml}</div>");
            })
            ->toJson();
    }
}
