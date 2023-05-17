<?php

namespace App\Http\Controllers\Admin\Events;

use App\Models\Home\Events\Event;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\View\View;
use Illuminate\Support\HtmlString;
use Illuminate\Http\{Request, RedirectResponse, JsonResponse};

class EventController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() : View
    {

        $fields = [
            [
                'name' => 'name_ru',
                'label' => 'Название события на русском',
                'required' => true,
            ],
            [
                'name' => 'name_en',
                'label' => 'Название события на английском',
                'required' => true,
            ],
            [
                'name' => 'duration_ru',
                'label' => 'Длительность события на русском',
                'required' => false,
            ],
            [
                'name' => 'duration_en',
                'label' => 'Длительность события на английском',
                'required' => false,
            ],
            [
                'name' => 'presenter_ru',
                'label' => 'Ведущий события (на русском)',
                'required' => true,
            ],
            [
                'name' => 'presenter_en',
                'label' => 'Ведущий события (на английском)',
                'required' => true,
            ],
            [
                'name' => 'price',
                'label' => 'Цена ($)',
                'required' => false,
            ],
            [
                'name' => 'start',
                'label' => 'Дата начала события (2021-12-21 20:00:00) по мск',
                'required' => false,
            ],
            [
                'name' => 'details_ru',
                'label' => 'Детали на русском',
                'type' => 'textarea',
                'required' => true,
            ],
            [
                'name' => 'details_en',
                'label' => 'Детали на английском',
                'type' => 'textarea',
                'required' => true,
            ],
        ];

        return view('admin.includes.partials.crud-form', [
            'title' => 'Events > Создание события',
            'action_route' => route('admin.events.event.store'),
            'action_name' => 'Создать',
            'action_method' => 'post',
            'route_back' => route('admin.events.index'),
            'fields' => $fields,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'name_ru' => 'required|string|min:2|max:191',
            'name_en' => 'required|string|min:2|max:191',
            'details_ru' => 'required|string|min:2|max:191',
            'details_en' => 'required|string|min:2|max:191',
            'duration_ru' => 'required|string|min:2',
            'duration_en' => 'required|string|min:2',
            'price' => 'string',
            'presenter_ru' => 'required|string|min:2|max:191',
            'presenter_en' => 'required|string|min:2|max:191',
            'start' => 'required|string|min:6'
        ]);

        $details_ru = preg_replace('"\b(https?://\S+)"', '<a style="color: #1448B6" href="$1">$1 </a>', $requestData['details_ru']);
        $details_en = preg_replace('"\b(https?://\S+)"', '<a style="color: #1448B6" href="$1">$1 </a>', $requestData['details_en']);
        
        Event::create([
            'name' => [
                'ru' => $requestData['name_ru'],
                'en' => $requestData['name_en'],
            ],
            'details' => [
                'ru' => $details_ru,
                'en' => $details_en,
            ],
            'duration' => [
                'ru' => $requestData['duration_ru'],
                'en' => $requestData['duration_en'],
            ],
            'presenter' => [
                'ru' => $requestData['presenter_ru'],
                'en' => $requestData['presenter_en'],
            ],
            'price' => $requestData['price'],
            'start' => $requestData['start']
        ]);

        return redirect()->route('admin.events.index')
            ->with('status', 'Событие успешно создано');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {

        $fields = [
            [
                'name' => 'name_ru',
                'label' => 'Название события на русском',
                'required' => true,
                'value' => $event->getTranslation('name', 'ru')
            ],
            [
                'name' => 'name_en',
                'label' => 'Название события на английском',
                'required' => true,
                'value' => $event->getTranslation('name', 'en')
            ],
            [
                'name' => 'duration_ru',
                'label' => 'Длительность события на русском',
                'required' => false,
                'value' => $event->getTranslation('duration', 'ru')
            ],
            [
                'name' => 'duration_en',
                'label' => 'Длительность события на английском',
                'required' => false,
                'value' => $event->getTranslation('duration', 'en')
            ],
            [
                'name' => 'presenter_ru',
                'label' => 'Ведущий события (на русском)',
                'required' => true,
                'value' => $event->getTranslation('presenter', 'ru')
            ],
            [
                'name' => 'presenter_en',
                'label' => 'Ведущий события (на английском)',
                'required' => true,
                'value' => $event->getTranslation('presenter', 'en')
            ],
            [
                'name' => 'price',
                'label' => 'Цена ($)',
                'required' => false,
                'value' => $event->price
            ],
            [
                'name' => 'start',
                'label' => 'Дата начала события (2021-12-21 20:00:00) по мск',
                'required' => false,
                'value' => $event->start
            ],
            [
                'name' => 'details_ru',
                'label' => 'Детали на русском',
                'type' => 'textarea',
                'required' => true,
                'value' => $event->getTranslation('details', 'ru')
            ],
            [
                'name' => 'details_en',
                'label' => 'Детали на английском',
                'type' => 'textarea',
                'required' => true,
                'value' => $event->getTranslation('details', 'en')
            ],
        ];

        return view('admin.includes.partials.crud-form', [
            'title' => 'Events > Редактирование события',
            'action_route' => route('admin.events.event.update', $event->id),
            'action_name' => 'Сохранить',
            'action_method' => 'patch',
            'route_back' => route('admin.events.index'),
            'fields' => $fields,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Event $event, Request $request)
    {
        $requestData = $request->validate([
            'name_ru' => 'required|string|min:2|max:191',
            'name_en' => 'required|string|min:2|max:191',
            'details_ru' => 'required|string|min:2|max:191',
            'details_en' => 'required|string|min:2|max:191',
            'duration_ru' => 'required|string|min:2',
            'duration_en' => 'required|string|min:2',
            'price' => 'string',
            'presenter_ru' => 'required|string|min:2|max:191',
            'presenter_en' => 'required|string|min:2|max:191',
            'start' => 'required|string|min:6'
        ]);

        $details_ru = preg_replace('"\b(https?://\S+)"', '<a style="color: #1448B6" href="$1">$1 </a>', $requestData['details_ru']);
        $details_en = preg_replace('"\b(https?://\S+)"', '<a style="color: #1448B6" href="$1">$1 </a>', $requestData['details_en']);

        $event->update([
            'name' => [
                'ru' => $requestData['name_ru'],
                'en' => $requestData['name_en'],
            ],
            'details' => [
                'ru' => $details_ru,
                'en' => $details_en,
            ],
            'price' => $requestData['price'],
            'presenter' => [
                'ru' => $requestData['presenter_ru'],
                'en' => $requestData['presenter_en'],
            ],
            'duration' => [
                'ru' => $requestData['duration_ru'],
                'en' => $requestData['duration_en'],
            ],
            'start' => $requestData['start']
        ]);

        return redirect()->route('admin.events.index')
            ->with('status', 'Событие успешно обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

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
        $query = Event::query()
            ->orderByDesc('updated_at')
            ->select([
                'id',
                'name',
                'presenter',
                'start',
                'duration',
                'details',
                'price',
                'created_at',
                'updated_at',
            ]);

        return DataTables::eloquent($query)
            ->editColumn('name', function (Event $event) {
                return $event->name;
            })
            ->addColumn('actions', function (Event $event) {
                $editButtonHtml = '<a href="' . route('admin.events.event.edit', $event->id) . '"
                                      class="btn btn-sm">✏️</a>';
                $deleteButtonHtml = '
                <form method="post"
                      action="' . route('admin.events.event.destroy', $event->id) . '"
                      onsubmit="return confirm(\'Удалить ' . $event->name . '?\');">'
                . '<input type="hidden" name="_method" value="delete"/>'
                . csrf_field()
                . '<button type="submit" class="btn">🗑️</button>'
            . '</form>';
                return new HtmlString("<div style='display: flex; align-items: center;'>{$editButtonHtml} {$deleteButtonHtml}</div>");
            })
            ->toJson();
    }
}
