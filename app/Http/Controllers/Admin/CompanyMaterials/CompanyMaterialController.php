<?php

namespace App\Http\Controllers\Admin\CompanyMaterials;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\View\View;
use Illuminate\Support\HtmlString;
use Illuminate\Http\{Request, RedirectResponse, JsonResponse};
use App\Models\Home\CompanyMaterials\CompanyMaterial;

class CompanyMaterialController extends Controller
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
                'label' => 'Название материала на русском',
                'required' => true,
            ],
            [
                'name' => 'name_en',
                'label' => 'Название материала на английском',
                'required' => true,
            ],
            [
                'name' => 'describe_ru',
                'label' => 'Описание материала на русском',
                'type' => 'textarea',
                'required' => true
            ],
            [
                'name' => 'describe_en',
                'label' => 'Описание материала на английском',
                'type' => 'textarea',
                'required' => true
            ],
            [
                'name' => 'pdf',
                'label' => 'Файл pdf',
                'type' => 'file',
            ]
        ];

        return view('admin.includes.partials.crud-form', [
            'title' => 'Материалы компании > Создание нового материала',
            'action_route' => route('admin.companyMaterials.companyMaterial.store'),
            'action_name' => 'Создать',
            'action_method' => 'post',
            'route_back' => route('admin.companyMaterials.index'),
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
            'name_ru'  => 'required|string|min:2|max:127',
            'name_en'  => 'required|string|min:2|max:127',
            'describe_ru' => 'required|string|min:2',
            'describe_en' => 'required|string|min:2',
            'pdf'      => 'required|file|mimes:pdf|max:15000',
        ]);

        DB::transaction(function () use ($request, $requestData) {

            $companyMaterial = CompanyMaterial::create([
                'name' => [
                    'ru' => $requestData['name_ru'],
                    'en' => $requestData['name_en'],
                ],
                'describe' => [
                    'ru' => $requestData['describe_ru'],
                    'en' => $requestData['describe_en'],
                ]
            ]);

            if ($file = $request->file('pdf')) {
                $fileExtension = $file->getClientOriginalExtension();
                $fileNameToStore = hash('sha256', 'company-material' . $companyMaterial->id) . '.' . $fileExtension;
                $filePath = $file->storeAs('public/uploads', $fileNameToStore);

                $companyMaterial->pdf = $filePath;
            }

            $companyMaterial->save();
        });
        return redirect()->route('admin.companyMaterials.index')
            ->with('status', 'Материал успешно создан');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyMaterial $companyMaterial)
    {
        $fields = [
            [
                'name' => 'name_ru',
                'label' => 'Название материала на русском',
                'required' => true,
                'value' => $companyMaterial->getTranslation('name', 'ru')
            ],
            [
                'name' => 'name_en',
                'label' => 'Название материала на английском',
                'required' => true,
                'value' => $companyMaterial->getTranslation('name', 'en')
            ],
            [
                'name' => 'describe_ru',
                'label' => 'Описание материала на русском',
                'type' => 'textarea',
                'required' => true,
                'value' => $companyMaterial->getTranslation('describe', 'ru')
            ],
            [
                'name' => 'describe_en',
                'label' => 'Описание материала на английском',
                'type' => 'textarea',
                'required' => true,
                'value' => $companyMaterial->getTranslation('describe', 'en')
            ],
            [
                'name' => 'pdf',
                'label' => 'Файл pdf',
                'type' => 'file',
            ]
        ];
        
        return view('admin.includes.partials.crud-form', [
            'title' => 'Презентационные материалы компании > Редактирование материала',
            'action_route' => route('admin.companyMaterials.companyMaterial.update', $companyMaterial->id),
            'action_name' => 'Сохранить',
            'action_method' => 'patch',
            'route_back' => route('admin.companyMaterials.index'),
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
    public function update(CompanyMaterial $companyMaterial, Request $request)
    {
        $requestData = $request->validate([
            'name_ru'  => 'required|string|min:2|max:127',
            'name_en'  => 'required|string|min:2|max:127',
            'describe_ru' => 'required|string|min:2',
            'describe_en' => 'required|string|min:2',
            'pdf'      => 'required|file|mimes:pdf|max:15000',
        ]);

        DB::transaction(function () use ($companyMaterial, $request, $requestData) {

            foreach (['name', 'describe'] as &$attribute) {
                $companyMaterial->setAttribute($attribute, [
                    'ru' => $requestData[$attribute . '_ru'],
                    'en' => $requestData[$attribute . '_en'],
                ]);
                unset($attribute);
            }

            if ($file = $request->file('pdf')) {
                $fileExtension = $file->getClientOriginalExtension();
                $fileNameToStore = hash('sha256', 'company-material' . $companyMaterial->id) . '.' . $fileExtension;
                $filePath = $file->storeAs('public/uploads', $fileNameToStore);
                $companyMaterial->pdf = $filePath;
            }
            $companyMaterial->save();
        });


        return redirect()->route('admin.companyMaterials.index')
            ->with('status', 'Материал успешно обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyMaterial $companyMaterial): RedirectResponse
    {
        $companyMaterial->delete();

        return redirect()->back()
            ->with('status', 'Материал успешно удален');
    }


    /**
     * Получить данные для таблицы
     *
     * @return JsonResponse
     */
    public function getTableData(): JsonResponse
    {
        $query = CompanyMaterial::query()
            ->orderByDesc('updated_at')
            ->select([
                'id',
                'name',
                'created_at',
                'updated_at',
            ]);

        return DataTables::eloquent($query)
            ->editColumn('name', function (CompanyMaterial $companyMaterial) {
                return $companyMaterial->name;
            })
            ->addColumn('actions', function (CompanyMaterial $companyMaterial) {
                $editButtonHtml = '<a href="' . route('admin.companyMaterials.companyMaterial.edit', $companyMaterial->id) . '"
                                      class="btn btn-sm">✏️</a>';
                $deleteButtonHtml = '
                <form method="post"
                      action="' . route('admin.companyMaterials.companyMaterial.destroy', $companyMaterial->id) . '"
                      onsubmit="return confirm(\'Удалить ' . $companyMaterial->name . '?\');">'
                    . '<input type="hidden" name="_method" value="delete"/>'
                    . csrf_field()
                    . '<button type="submit" class="btn">🗑️</button>'
                    . '</form>';
                return new HtmlString("<div style='display: flex; align-items: center;'>{$editButtonHtml} {$deleteButtonHtml}</div>");
            })
            ->toJson();
    }
}
