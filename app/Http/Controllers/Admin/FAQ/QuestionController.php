<?php

namespace App\Http\Controllers\Admin\FAQ;

use App\Models\Home\FAQ\{Question, Category};
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\View\View;
use Illuminate\Support\HtmlString;
use Illuminate\Http\{Request, RedirectResponse, JsonResponse};

class QuestionController extends Controller
{
    /**
     * Форма создания
     *
     * @return View
     */
    public function create(): View
    {
        $categoryOptions = Category::query()
            ->select('name->' . app()->getLocale() . ' as label', 'id as value')
            ->get();

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
                'name' => 'answer_ru',
                'label' => 'Ответ на русском',
                'type' => 'textarea',
                'required' => true,
            ],
            [
                'name' => 'answer_en',
                'label' => 'Ответ на английском',
                'type' => 'textarea',
                'required' => true,
            ],
            [
                'name' => 'category',
                'label' => 'Категория',
                'type' => 'select',
                'options' => $categoryOptions,
                'required' => true,
            ],
        ];

        return view('admin.includes.partials.crud-form', [
            'title' => 'FAQ > Создание вопроса',
            'action_route' => route('admin.faq.question.store'),
            'action_name' => 'Создать',
            'action_method' => 'post',
            'route_back' => route('admin.faq.index'),
            'fields' => $fields,
        ]);
    }

    /**
     * Создать вопрос
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function store(Request $request): RedirectResponse
    {
        $requestData = $request->validate([
            'name_ru' => 'required|string|min:2|max:200',
            'name_en' => 'required|string|min:2|max:200',
            'answer_ru' => 'required|string|min:2',
            'answer_en' => 'required|string|min:2',
            'category' => 'required|exists:faq_categories,id',
        ]);

        Question::create([
            'name' => [
                'ru' => $requestData['name_ru'],
                'en' => $requestData['name_en'],
            ],
            'answer' => [
                'ru' => $requestData['answer_ru'],
                'en' => $requestData['answer_en'],
            ],
            'category_id' => Category::findOrFail($requestData['category'])->id,
        ]);

        return redirect()->route('admin.faq.index')
            ->with('status', 'Вопрос успешно создан');
    }

    /**
     * Форма редактирования
     *
     * @param Question $question
     * @return View
     */
    public function edit(Question $question): View
    {
        $categoryOptions = Category::query()
            ->select('name->' . app()->getLocale() . ' as label', 'id as value')
            ->get()
            ->transform(function ($item) use ($question) {
                if ($item->value === $question->category->id) {
                    $item->selected = true;
                }

                return $item;
            });

        $fields = [
            [
                'name' => 'id',
                'label' => '#',
                'value' => $question->id,
                'readonly' => true,
            ],
            [
                'name' => 'name_ru',
                'label' => 'Название на русском',
                'value' => $question->getTranslation('name', 'ru'),
                'required' => true,
            ],
            [
                'name' => 'name_en',
                'label' => 'Название на английском',
                'value' => $question->getTranslation('name', 'en'),
                'required' => true,
            ],
            [
                'name' => 'answer_ru',
                'label' => 'Ответ на русском',
                'type' => 'textarea',
                'value' => $question->getTranslation('answer', 'ru'),
                'required' => true,
            ],
            [
                'name' => 'answer_en',
                'label' => 'Ответ на английском',
                'type' => 'textarea',
                'value' => $question->getTranslation('answer', 'en'),
                'required' => true,
            ],
            [
                'name' => 'category',
                'label' => 'Категория',
                'type' => 'select',
                'options' => $categoryOptions,
                'required' => true,
            ],
            [
                'name' => 'created_at',
                'label' => 'Создан',
                'value' => $question->created_at,
                'readonly' => true,
            ],
            [
                'name' => 'updated_at',
                'label' => 'Изменен',
                'value' => $question->updated_at,
                'readonly' => true,
            ],
        ];

        return view('admin.includes.partials.crud-form', [
            'title' => 'FAQ > Редактирование вопроса',
            'action_route' => route('admin.faq.question.update', $question->id),
            'action_name' => 'Сохранить',
            'action_method' => 'patch',
            'route_back' => route('admin.faq.index'),
            'fields' => $fields,
        ]);
    }

    /**
     * Обновить вопрос
     *
     * @param Question $question
     * @param Request $request
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function update(Question $question, Request $request): RedirectResponse
    {
        $requestData = $request->validate([
            'name_ru' => 'required|string|min:2|max:200',
            'name_en' => 'required|string|min:2|max:200',
            'answer_ru' => 'required|string|min:2',
            'answer_en' => 'required|string|min:2',
            'category' => 'required|exists:faq_categories,id',
        ]);

        $question->update([
            'name' => [
                'ru' => $requestData['name_ru'],
                'en' => $requestData['name_en'],
            ],
            'answer' => [
                'ru' => $requestData['answer_ru'],
                'en' => $requestData['answer_en'],
            ],
            'category_id' => $requestData['category'],
        ]);

        return redirect()->route('admin.faq.index')
            ->with('status', 'Вопрос успешно обновлен');
    }

    /**
     * Удалить вопрос
     *
     * @param Question $question
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Question $question): RedirectResponse
    {
        $question->delete();

        return redirect()->back()
            ->with('status', 'Вопрос успешно удален');
    }

    /**
     * Получить данные для таблицы
     *
     * @return JsonResponse
     */
    public function getTableData(): JsonResponse
    {
        $query = Question::query()
            ->with('category:id,name')
            ->orderByDesc('updated_at')
            ->select([
                'id',
                'name',
                'category_id',
                'created_at',
                'updated_at',
            ]);

        return DataTables::eloquent($query)
            ->editColumn('name', function (Question $category) {
                return $category->name;
            })
            ->addColumn('category', function (Question $question) {
                return $question->category->name;
            })
            ->addColumn('actions', function (Question $question) {
                $editButtonHtml = '<a href="' . route('admin.faq.question.edit', $question->id) . '" class="btn btn-sm">✏️</a>';
                $deleteButtonHtml = '<form method="post" action="' . route('admin.faq.question.destroy', $question->id) . '" onsubmit="return confirm(\'Удалить ' . $question->name . '?\');">'
                    . '<input type="hidden" name="_method" value="delete"/>'
                    . csrf_field()
                    . '<button type="submit" class="btn">🗑️</button>'
                    . '</form>';

                return new HtmlString("<div style='display: flex; align-items: center;'>{$editButtonHtml} {$deleteButtonHtml}</div>");
            })
            ->toJson();
    }
}
