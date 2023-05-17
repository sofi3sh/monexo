<?php

namespace App\Models\Consts;

use Illuminate\Database\Eloquent\Model;


class ServicesConstants extends Model
{
    const STATUS = [
        'white' => 1,
        'done'  => 2,
    ];

    const PRICE = [
        'instagram_packaging' => 400,
        'instagram_escorts' => [
            'month1' => 200,
            'month6' => 1000,
            'month12' => 1800,
        ],
        'develop_landing_page' => 200,
        'develop_corp_site' => 400,
        'develop_internet_magazine' => 800,
        'develop_mobile_app' => 1000,
        'promotion_social_network' => 200,
        'target_ad' => 300,
        'context_ad' => 300,
        'seo' => 100,
        'tunnel_sales' => 400,
        'brand_book' => 200,
        'visual_content' => 100,
        'presentations' => 40,
        'ux_ui' => 100,
        'sticker' => 30,
        'design_ad_creatives' => 10,
        'video_editing' => 70,
        'script_video' => 40,
    ];

    const DESCR = [
        'instagram_packaging' => 'BlogTime: Упаковка Instagram',
        'instagram_escorts' => 'BlogTime: Сопровождение Instagram',
        'develop_landing_page' => 'BusinessPack: Разработка. Создание LandingPage',
        'develop_corp_site' => 'BusinessPack: Разработка. Создание корпоративного сайта',
        'develop_internet_magazine' => 'BusinessPack: Разработка. Создание интернет-магазина',
        'develop_mobile_app' => 'BusinessPack: Разработка. Разработка мобильных приложений',
        'promotion_social_network' => 'BusinessPack: Продвижение. Упаковка социальных сетей',
        'target_ad' => 'BusinessPack: Продвижение. Таргетинговая реклама',
        'context_ad' => 'BusinessPack: Продвижение. Контекстная реклама',
        'seo' => 'BusinessPack: Продвижение. SЕО-оптимизация внутренняя',
        'tunnel_sales' => 'BusinessPack: Продвижение. Разработка туннелей продаж',
        'brand_book' => 'BusinessPack: Дизайн. Визуальная концепция бизнеса (бренд бук)',
        'visual_content' => 'BusinessPack: Дизайн. Визуальный контент для соц. сетей',
        'presentations' => 'BusinessPack: Дизайн. Презентации.',
        'ux_ui' => 'BusinessPack: Дизайн. UX/UI дизайн веб-сайта',
        'sticker' => 'BusinessPack: Дизайн. Стикеры',
        'design_ad_creatives' => 'BusinessPack: Дизайн. Дизайн рекламных креативов',
        'video_editing' => 'BusinessPack: Создание видео-контента. Монтаж видеороликов',
        'script_video' => 'BusinessPack: Создание видео-контента. Сценарии для видеороликов',
    ];
}

