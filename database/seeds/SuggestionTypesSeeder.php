<?php

use App\Models\UserStatus;
use Illuminate\Database\Seeder;

class SuggestionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'id' => 1,
                'title_ru' => 'Новая возможность, функционал',
                'title_en' => 'New feature, functionality'
            ],[
                'id' => 2,
                'title_ru' => 'Партнёрская программа',
                'title_en' => 'Affiliate program'
            ],[
                'id' => 3,
                'title_ru' => 'Пассивный доход',
                'title_en' => 'Passive income'
            ],[
                'id' => 4,
                'title_ru' => 'Продукты компании',
                'title_en' => 'Products of the company'
            ],
        ];

        foreach ($types as $type) {
            DB::table('suggestion_types')->updateOrInsert(
                ['id' => $type['id']],
                [
                    'title_ru' => $type['title_ru'],
                    'title_en' => $type['title_en']
                ]
            );
        }
    }
}
