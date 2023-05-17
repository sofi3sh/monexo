<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MailSendRequest;
use App\Services\MailSendService;
use Log;

class AdminMailControoler extends Controller
{

    public function index()
    {
        $fields = [
            [
                'name' => 'subject_ru',
                'label' => 'Тема письма на русском',
                'required' => true,
            ],
            [
                'name' => 'subject_en',
                'label' => 'Тема письма на английском',
                'required' => true,
            ],
            [
                'name' => 'title_ru',
                'label' => 'Заголовок на русском',
                'required' => true,
            ],
            [
                'name' => 'title_en',
                'label' => 'Заголовок на английском',
                'required' => true,
            ],
            [
                'name' => 'content_ru',
                'label' => 'Контент на русском',
                'type' => 'textarea',
                'rows' => 10,
                'required' => true,
            ],
            [
                'name' => 'content_en',
                'label' => 'Контент на английском',
                'type' => 'textarea',
                'rows' => 10,
                'required' => true,
            ],
            [
                'name'  => 'type',
                'label' => 'Всем, у кого есть партнёры',
                'value' => 'referrers',
                'type'  => 'radio',
            ],
            [
                'name'  => 'type',
                'label' => 'Всем пользователям',
                'value' => 'all',
                'type'  => 'radio',
            ]
        ];

        return view('admin.includes.partials.crud-form', [
            'title' => 'Отправить письмо',
            'action_route' => route('admin.mail.send'),
            'action_name' => 'Отправить',
            'action_method' => 'post',
            'fields' => $fields,
        ]);
    }
    
    public function send(MailSendRequest $request)
    {
        $type = $request->input('type');
        $info = [
            'subject' => [
                'ru' => $request->input('subject_ru'),
                'en' => $request->input('subject_en'),
            ],
            'title'  => [
                'ru' => $request->input('title_ru'),
                'en' => $request->input('title_en'),
            ],
            'content' => [
                'ru' => $request->input('content_ru'),
                'en' => $request->input('content_en')
            ]
        ];
        
        $service = new MailSendService($type);
        $service->send($info);

        Log::info('Задача принята в обработку');
        return redirect()->back()->with('status', 'Задача принята в обработку');
    }


}
