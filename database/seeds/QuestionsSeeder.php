<?php

use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('questions')->insertOrIgnore([
            [
                'id'            => 1,
                'module_id'     => 1,
                'question'      => 'Почему важно выбрать правильное позиционирование на рынке? Как позиционирование связано с целевой аудиторией?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 2,
                'module_id'     => 1,
                'question'      => 'В чем отличие понятий целевая аудитория и Аватар клиента? Сколько аватаров клиента рекомендовано выбирать на старте?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 3,
                'module_id'     => 1,
                'question'      => 'Представьте следующую ситуацию. Вы студент и пришли в новую сетевую компанию. Какую аудиторию вам лучше выбрать, если до этого вы уже были в сетевом, но ничего не заработали? Аргументируйте свой ответ.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 4,
                'module_id'     => 1,
                'question'      => 'Опишите ваши профессиональные результаты через год? Кем вы себя видите? Какая у вас команда? Как выглядят ваши социальные сети?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 5,
                'module_id'     => 2,
                'question'      => 'Напишите главную цель, которую выполняет шапка профиля в соц. сетях?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 6,
                'module_id'     => 2,
                'question'      => 'На что лучше указать ссылку в шапке Инстаграм? Бесплатный PDF? What’s App? Реферальная ссылка компании? На ролик о компании? Почему вы так считаете?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 7,
                'module_id'     => 2,
                'question'      => 'Для чего нужны лидеры мнений? Как можно использовать их с выгодой для себя?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 8,
                'module_id'     => 3,
                'question'      => 'Сколько постов о компании нужно публиковать в месяц?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 9,
                'module_id'     => 3,
                'question'      => 'Какую роль играет заголовок в рекламном посте?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 10,
                'module_id'     => 3,
                'question'      => 'Какой % продающего контента должен быть в вашем аккаунте?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 11,
                'module_id'     => 3,
                'question'      => 'В чем отличие экспертного и продающего текста? По каким признакам можно определить вид поста?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 12,
                'module_id'     => 3,
                'question'      => 'В каких видах постов можно использовать триггеры продаж.',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 13,
                'module_id'     => 4,
                'question'      => 'Какие две позиции в переговорах являются провальными? Почему вы так считаете?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 14,
                'module_id'     => 4,
                'question'      => 'Что нужно сделать, перед тем как проводить консультацию кандидату? Пропишите максимально подробно порядок ваших действий',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 15,
                'module_id'     => 4,
                'question'      => 'Назовите минимальную цель, которую вам необходимо достичь в переговорах?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 16,
                'module_id'     => 4,
                'question'      => 'В каких двух случаях переговоры можно считать завершёнными?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 17,
                'module_id'     => 5,
                'question'      => 'Когда можно закладывать на рекламу большой бюджет?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 18,
                'module_id'     => 5,
                'question'      => 'Что лучшие всего писать на страницах лидеров мнений, чтобы привлечь внимание целевой аудитории?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 19,
                'module_id'     => 5,
                'question'      => 'Идеальное время для оставления комментариев на страницах лидеров мнений?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 20,
                'module_id'     => 5,
                'question'      => 'Какие способы рекламы приводят ледяной трафик?',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ]);

        echo "Rows: $rows\n";
    }
}
