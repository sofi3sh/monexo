<?php

namespace App\Http\Controllers\Admin;

use App\Models\Map;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    public function __construct()
    {
        $this->partnersMap = Map::find(1);
    }

    public function index()
    {
        $partnersMap = $this->partnersMap;
        return view('admin.maps.partners-map', compact('partnersMap'));
    }

    public function update(Request $request)
    {

        $requestData = $request->validate([
            'code' => 'required',
            'show' => 'bool',
        ]);

        $this->partnersMap->update([
            'code' => $requestData['code'],
            'show' => $requestData['show'] ?? false,
        ]);

        return redirect()->route('admin.partners-map.index')
            ->with('status', 'Карта партнеров успешно обновлена');
    }

    public function edit()
    {

        $fields = [
            [
                'name' => 'code',
                'label' => 'Код для карты партнеров',
                'type' => 'textarea',
                'rows' => 5,
                'required' => true,
                'value' => $this->partnersMap->code
            ],
            [
                'name' => 'show',
                'label' => 'Опубликовать?',
                'type' => 'checkbox',
                'value' => $this->partnersMap->show
            ],
        ];

        return view('admin.includes.partials.crud-form', [
            'title' => 'Карта партнеров (редактирование)',
            'action_route' => route('admin.partners-map.update'),
            'action_name' => 'Сохранить',
            'action_method' => 'post',
            'route_back' => route('admin.partners-map.index'),
            'fields' => $fields,
        ]);
    }


}
