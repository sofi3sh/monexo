<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;


class AlertTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("DELETE FROM `alert_types`");
        DB::table('alert_types')->insert([
                [
                    'id'         => 1,
                    'message_ru'    => 'пополнение счёта',
                    'message_en'    => 'replenishment account',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id'         => 2,
                    'message_ru'    => 'вывод средств',
                    'message_en'    => 'withdrawal of funds',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id'         => 3,
                    'message_ru'    => 'открытие инвестиционной линии',
                    'message_en'    => 'opening an investment line',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id'         => 4,
                    'message_ru'    => 'начисление ежедневной прибыли по инвестиционной линии',
                    'message_en'    => 'accrual of daily profit on the investment line',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id'         => 5,
                    'message_ru'    => 'окончание инвестиционной линии через 24 часа',
                    'message_en'    => 'end of the investment line in 24 hours',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id'         => 6,
                    'message_ru'    => 'окончание инвестиционной линии',
                    'message_en'    => 'end of investment line',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id'         => 7,
                    'message_ru'    => 'регистрация нового партнёра по реф. ссылке',
                    'message_en'    => 'registration of a new partner in ref. the link',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id'         => 8,
                    'message_ru'    => 'начисление реферальной прибыли',
                    'message_en'    => 'accrual of referral profit',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id'         => 9,
                    'message_ru'    => 'пополнение счёта партнёром',
                    'message_en'    => 'partner replenishment',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id'         => 10,
                    'message_ru'    => 'начисление ежедневного процента на остаток на балансе',
                    'message_en'    => 'accrual of daily interest on the balance sheet',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id'         => 11,
                    'message_ru'    => 'начисление бонусов',
                    'message_en'    => 'accrual of bonuses',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id'         => 12,
                    'message_ru'    => 'Запрос на ввод монетой',
                    'message_en'    => 'Request deposit coin',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id'         => 13,
                    'message_ru'    => 'Ввод монетой',
                    'message_en'    => 'Deposit coin',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'id'         => 14,
                    'message_ru'    => 'Запрос на ввод монетой удален',
                    'message_en'    => 'Request deposit coin deleted',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                

            ]
        );
    }
}
