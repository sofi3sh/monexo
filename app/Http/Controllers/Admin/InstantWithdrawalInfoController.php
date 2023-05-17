<?php

namespace App\Http\Controllers\Admin;

use App\Models\InstantWithdrawalInfo;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\HtmlString;
use Illuminate\Http\{Request, RedirectResponse};

class InstantWithdrawalInfoController extends Controller
{

    public function __construct() {
        $this->info = InstantWithdrawalInfo::find('1');
    }

    public function index() {
        $withdrawalModal = InstantWithdrawalInfo::select('title', 'content')->find(1);
        return view('admin.instantWithdrawalInfo.index', compact('withdrawalModal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $info = $this->info;

        $fields = [
            [
                'name' => 'title_ru',
                'label' => 'Заголовок на русском',
                'required' => true,
                'value' => $info->getTranslation('title', 'ru')
            ],
            [
                'name' => 'title_en',
                'label' => 'Заголовок на английском',
                'required' => true,
                'value' => $info->getTranslation('title', 'en')
            ],
            [
                'name' => 'content_ru',
                'label' => 'Контент на русском языке',
                'type' => 'textarea',
                'rows' => 10,
                'required' => true,
                'value' => $info->getTranslation('content', 'ru')
            ],
            [
                'name' => 'content_en',
                'label' => 'Контент на английском языке',
                'rows' => 10,
                'type' => 'textarea',
                'required' => true,
                'value' => $info->getTranslation('content', 'en')
            ],
        ];

        return view('admin.includes.partials.crud-form', [
            'title' => 'Редактирование информации о моментальном выводе',
            'action_route' => route('admin.withdrawalModalInfo.update'),
            'action_name' => 'Сохранить',
            'action_method' => 'post',
            'route_back' => route('admin.withdrawalModalInfo.index'),
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
    public function update(Request $request)
    {
        $info = $this->info;

        $requestData = $request->validate([
            'title_ru' => 'required|string|min:2|max:255',
            'title_en' => 'required|string|min:2|max:255',
            'content_en' => 'required|min:2',
            'content_ru' => 'required|min:2'
        ]);

        $info->update([
            'title' => [
                'ru' => $requestData['title_ru'],
                'en' => $requestData['title_en'],
            ],
            'content' => [
                'ru' => $requestData['content_ru'],
                'en' => $requestData['content_en'],
            ]
        ]);

        return redirect()->route('admin.withdrawalModalInfo.index')
            ->with('status', 'Событие успешно обновлено');
    }
}
