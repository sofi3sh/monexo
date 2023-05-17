<?php

use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('services')->insertOrIgnore([
            [
                'id'            => 1,
                'name_en'       => 'instagram_packaging',
                'name_ru'       => 'Instagram packaging',
                'name_english'  => '',
                'price_usd'     => 400,
                'services_category_id' => 1,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 2,
                'name_en'       => 'instagram_escorts_month1',
                'name_ru'       => 'Сопровождение Instagram 1 мес.',
                'name_english'  => 'Accompaniment of Instagram 1 month.',
                'price_usd'     => 200,
                'services_category_id' => 1,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 3,
                'name_en'       => 'instagram_escorts_month6',
                'name_ru'       => 'Сопровождение Instagram 6 мес.',
                'name_english'  => 'Escort Instagram 6 months',
                'price_usd'     => 1000,
                'services_category_id' => 1,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 4,
                'name_en'       => 'instagram_escorts_month12',
                'name_ru'       => 'Сопровождение Instagram 12 мес.',
                'name_english'  => 'Escort Instagram 12 months',
                'price_usd'     => 1800,
                'services_category_id' => 1,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 5,
                'name_en'       => 'develop_landing_page',
                'name_ru'       => 'Создание LandingPage',
                'name_english'  => 'LandingPage creation',
                'price_usd'     => 200,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 6,
                'name_en'       => 'develop_corp_site',
                'name_ru'       => 'Создание корпоративного сайта',
                'name_english'  => 'Creation of a corporate website',
                'price_usd'     => 400,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 7,
                'name_en'       => 'develop_internet_magazine',
                'name_ru'       => 'Создание интернет-магазина',
                'name_english'  => 'Online store creation',
                'price_usd'     => 800,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 8,
                'name_en'       => 'develop_mobile_app',
                'name_ru'       => 'Разработка мобильных приложений',
                'name_english'  => 'Development of mobile applications',
                'price_usd'     => 1000,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 9,
                'name_en'       => 'promotion_social_network',
                'name_ru'       => 'Упаковка социальных сетей',
                'name_english'  => 'Social media packaging',
                'price_usd'     => 200,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 10,
                'name_en'       => 'target_ad',
                'name_ru'       => 'Таргетинговая реклама',
                'name_english'  => 'Targeted advertising',
                'price_usd'     => 300,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 11,
                'name_en'       => 'context_ad',
                'name_ru'       => 'Контекстная реклама',
                'name_english'  => 'Contextual advertising',
                'price_usd'     => 300,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 12,
                'name_en'       => 'seo',
                'name_ru'       => 'SЕО-оптимизация внутренняя',
                'name_english'  => 'SEO-optimization internal',
                'price_usd'     => 100,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 13,
                'name_en'       => 'tunnel_sales',
                'name_ru'       => 'Разработка туннелей продаж',
                'name_english'  => 'Development of sales tunnels',
                'price_usd'     => 400,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 14,
                'name_en'       => 'brand_book',
                'name_ru'       => 'Визуальная концепция бизнеса (бренд бук)',
                'name_english'  => 'Business visual concept (brand beech)',
                'price_usd'     => 200,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 15,
                'name_en'       => 'visual_content',
                'name_ru'       => 'Визуальный контент для соц. сетей',
                'name_english'  => 'Visual content for social media networks',
                'price_usd'     => 100,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 16,
                'name_en'       => 'presentations',
                'name_ru'       => 'Презентации',
                'name_english'  => 'Presentations',
                'price_usd'     => 40,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 17,
                'name_en'       => 'ux_ui',
                'name_ru'       => 'UX/UI дизайн веб-сайта',
                'name_english'  => 'UX / UI website design',
                'price_usd'     => 100,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 18,
                'name_en'       => 'sticker',
                'name_ru'       => 'Стикеры',
                'name_english'  => 'Stickers',
                'price_usd'     => 30,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 19,
                'name_en'       => 'design_ad_creatives',
                'name_ru'       => 'Дизайн рекламных креативов',
                'name_english'  => 'Design of advertising creatives',
                'price_usd'     => 10,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 20,
                'name_en'       => 'video_editing',
                'name_ru'       => 'Монтаж видеороликов',
                'name_english'  => 'Video editing',
                'price_usd'     => 70,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 21,
                'name_en'       => 'script_video',
                'name_ru'       => 'Сценарии для видеороликов',
                'name_english'  => 'Scripts for videos',
                'price_usd'     => 40,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 22,
                'name_en'       => 'video_courses',
                'name_ru'       => 'Видеокурсы',
                'name_english'  => 'Video courses',
                'price_usd'     => 90,
                'services_category_id' => 3,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],

            [
                'id'            => 23,
                'name_en'       => 'audit',
                'name_ru'       => 'Аудит',
                'name_english'  => 'Audit',
                'price_usd'     => 300,
                'services_category_id' => 2,
                'is_active'     => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ]);

//        DB::table('services')
//            ->whereBetween('id', [1, 4])
//            ->update(['services_category_id' => 1]);
//
//        DB::table('services')
//            ->whereBetween('id', [5, 21])
//            ->update(['services_category_id' => 2]);
//
//        DB::table('services')
//            ->where('id', '=', 22)
//            ->update(['name_ru' => 'Видеокурсы', 'price_usd'     => 90,]);

        echo "Rows: $rows\n";
    }
}
