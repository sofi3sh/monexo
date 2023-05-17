<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class PartnerController extends Controller
{
    /**
     * Страница
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.includes.partials.partners.index');
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
                'name' => 'name',
                'label' => 'Имя',
                'required' => true,
            ],
            [
                'name' => 'surname',
                'label' => 'Фамилия',
                'required' => true,
            ],
            [
                'name' => 'city',
                'label' => 'Город',
                'required' => true,
            ],
            [
                'name' => 'phone',
                'type' => 'tel',
                'label' => 'Телефон',
            ],
            [
                'name' => 'telegram',
                'label' => 'Телеграм',
                'required' => true,
            ],
            [
                'name' => 'coordinates',
                'type' => 'map',
                'label' => 'Координаты',
                'required' => true,
            ],
            [
                'name' => 'date_birthday',
                'type' => 'date',
                'label' => 'Дата рождения',
                'required' => true,
            ],
        ];

        return view('admin.includes.partials.partners.form', [
            'title' => 'Партнеры > Создание партнера',
            'action_route' => route('admin.partner.store'),
            'action_name' => 'Создать',
            'action_method' => 'post',
            'route_back' => route('admin.partner.index'),
            'fields' => $fields,
        ]);
    }

    /**
     * Создать партнера
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $requestData = $request->validate([
            'name' => 'required|string|min:2|max:191',
            'surname' => 'required|string|min:2|max:191',
            'city' => 'required|string|min:2|max:191',
            'phone' => 'nullable|string|min:6|max:25',
            'telegram' => 'required|string|min:2|max:191',
            'date_birthday' => 'required|date_format:Y-m-d',
            'coordinates' => 'required|string|min:5',
        ]);

        $requestData['coordinates'] = json_decode($requestData['coordinates'], true);

        if (!$requestData['coordinates']['longitude'] || !$requestData['coordinates']['latitude']) {
            abort(422, 'Invalid coordinates');
        }

        $requestData['date_birthday'] = Carbon::parse($requestData['date_birthday']);

        Partner::create($requestData);

        return redirect()->route('admin.partner.index')
            ->with('status', 'Партнер успешно создан');
    }

    /**
     * Форма редактирования
     *
     * @param Partner $partner
     * @return View
     */
    public function edit(Partner $partner): View
    {
        $fields = [
            [
                'name' => 'id',
                'label' => '#',
                'value' => $partner->id,
                'readonly' => true,
            ],
            [
                'name' => 'name',
                'label' => 'Имя',
                'value' => $partner->name,
                'required' => true,
            ],
            [
                'name' => 'surname',
                'label' => 'Фамилия',
                'value' => $partner->surname,
                'required' => true,
            ],
            [
                'name' => 'city',
                'label' => 'Город',
                'value' => $partner->city,
                'required' => true,
            ],
            [
                'name' => 'phone',
                'type' => 'tel',
                'label' => 'Телефон',
                'value' => $partner->phone,
            ],
            [
                'name' => 'telegram',
                'label' => 'Телеграм',
                'value' => $partner->telegram,
                'required' => true,
            ],
            [
                'name' => 'date_birthday',
                'type' => 'date',
                'label' => 'Дата рождения',
                'value' => $partner->date_birthday,
                'required' => true,
            ],
            [
                'name' => 'coordinates',
                'type' => 'map',
                'label' => 'Координаты',
                'value' => $partner->coordinates,
                'required' => true,
            ],
            [
                'name' => 'created_at',
                'label' => 'Создан',
                'value' => $partner->created_at,
                'readonly' => true,
            ],
            [
                'name' => 'updated_at',
                'label' => 'Изменен',
                'value' => $partner->updated_at,
                'readonly' => true,
            ],
        ];

        return view('admin.includes.partials.partners.form', [
            'title' => 'Партнеры > Редактирование партнера',
            'action_route' => route('admin.partner.update', $partner->id),
            'action_name' => 'Сохранить',
            'action_method' => 'patch',
            'route_back' => route('admin.partner.index'),
            'fields' => $fields,
        ]);
    }

    /**
     * Обновить партнера
     *
     * @param Partner $partner
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Partner $partner, Request $request): RedirectResponse
    {
        $requestData = $request->validate([
            'name' => 'required|string|min:2|max:191',
            'surname' => 'required|string|min:2|max:191',
            'city' => 'required|string|min:2|max:191',
            'phone' => 'nullable|string|min:6|max:25',
            'telegram' => 'required|string|min:2|max:191',
            'date_birthday' => 'required|date_format:Y-m-d',
            'coordinates' => 'required|string|min:5',
        ]);

        $requestData['coordinates'] = json_decode($requestData['coordinates'], true);

        if (!$requestData['coordinates']['longitude'] || !$requestData['coordinates']['latitude']) {
            abort(422, 'Invalid coordinates');
        }

        $partner->update($requestData);

        return redirect()->route('admin.partner.index')
            ->with('status', 'Категория успешно обновлена');
    }

    /**
     * Удалить партнера
     *
     * @param Partner $partner
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Partner $partner): RedirectResponse
    {
        $partner->delete();

        return redirect()->back()
            ->with('status', 'Партнер успешно удален');
    }

    /**
     * Получить данные для таблицы
     *
     * @return JsonResponse
     */
    public function getTableData(): JsonResponse
    {
        $query = Partner::query()
            ->orderByDesc('created_at');

        return DataTables::eloquent($query)
            ->addColumn('actions', function (Partner $partner) {
                $editButtonHtml = '<a href="' . route('admin.partner.edit', $partner->id) . '" class="btn btn-sm">✏️</a>';
                $deleteButtonHtml = '<form method="post" action="' . route('admin.partner.destroy', $partner->id) . '" onsubmit="return confirm(\'Удалить ' . $partner->name . '?\');">'
                    . '<input type="hidden" name="_method" value="delete"/>'
                    . csrf_field()
                    . '<button type="submit" class="btn">🗑️</button>'
                    . '</form>';

                return new HtmlString("<div style='display: flex; align-items: center;'>{$editButtonHtml} {$deleteButtonHtml}</div>");
            })
            ->toJson();
    }
}
