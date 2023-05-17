<?php

use App\Models\Consts\AlertType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AlertTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('alert_types')->insertOrIgnore([
            0 =>
                [
                    'id' => 1,
                    'message_ru' => 'Пополнение',
                    'message_en' => 'Replenishment',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            1 =>
                [
                    'id' => 2,
                    'message_ru' => 'Вывод',
                    'message_en' => 'Withdrawal',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            2 =>
                [
                    'id' => 3,
                    'message_ru' => 'Покупка пакета',
                    'message_en' => 'Package purchase',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            3 =>
                [
                    'id' => 4,
                    'message_ru' => 'Прибыль от пакета',
                    'message_en' => 'Package Profit',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            4 =>
                [
                    'id' => 5,
                    'message_ru' => 'окончание инвестиционной линии через 24 часа',
                    'message_en' => 'end of the investment line in 24 hours',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            5 =>
                [
                    'id' => 6,
                    'message_ru' => 'окончание инвестиционной линии',
                    'message_en' => 'end of investment line',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            6 =>
                [
                    'id' => 7,
                    'message_ru' => 'Регистрация партнера',
                    'message_en' => 'Partner Registration',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            7 =>
                [
                    'id' => 8,
                    'message_ru' => 'Реферальные',
                    'message_en' => 'Referral',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            8 =>
                [
                    'id' => 9,
                    'message_ru' => 'Депозит партнера',
                    'message_en' => 'Partner deposit',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            9 =>
                [
                    'id' => 10,
                    'message_ru' => 'Начисление на остаток',
                    'message_en' => 'Charge on balance',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            10 =>
                [
                    'id' => 11,
                    'message_ru' => 'Бонус',
                    'message_en' => 'Bonus',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            11 =>
                [
                    'id' => 12,
                    'message_ru' => 'Запрос на ввод монетой',
                    'message_en' => 'Request deposit coin',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            12 =>
                [
                    'id' => 13,
                    'message_ru' => 'Ввод монетой',
                    'message_en' => 'Deposit coin',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            13 =>
                [
                    'id' => 14,
                    'message_ru' => 'Запрос на ввод монетой удален',
                    'message_en' => 'Request deposit coin deleted',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            14 =>
                [
                    'id' => 15,
                    'message_ru' => 'Бонус на выплату',
                    'message_en' => 'Payout bonus',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            15 =>
                [
                    'id' => 16,
                    'message_ru' => 'Бонусный депозит',
                    'message_en' => 'Bonus deposit',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            16 =>
                [
                    'id' => 17,
                    'message_ru' => 'Закрыть инвестиции',
                    'message_en' => 'Close investment',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            17 =>
                [
                    'id' => 18,
                    'message_ru' => 'Матчинг бонус',
                    'message_en' => 'Matching Bonus',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            18 =>
                [
                    'id' => 19,
                    'message_ru' => 'Вывод прибыли с пакета',
                    'message_en' => 'Withdraw profit from package',
                    'created_at' => '2020-03-29 13:08:09',
                    'updated_at' => '2020-03-29 13:08:09',
                ],
            19 =>
                [
                    'id' => 23,
                    'message_ru' => 'Система',
                    'message_en' => 'System',
                    'created_at' => '2020-11-29 23:23:23',
                    'updated_at' => '2020-11-29 23:23:23',
                ],
            20 =>
                [
                    'id' => 24,
                    'message_ru' => 'Покупка услуг',
                    'message_en' => 'Services buy',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            21 =>
                [
                    'id' => 25,
                    'message_ru' => 'Реферальные (BlogTime)',
                    'message_en' => 'Referral (BlogTime)',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            22 =>
                [
                    'id' => 26,
                    'message_ru' => 'Реферальные (BusinessPack)',
                    'message_en' => 'Referral (BusinessPack)',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            23 =>
                [
                    'id' => 27,
                    'message_ru' => 'Реферальные (Profi Universe)',
                    'message_en' => 'Referral (Profi Universe)',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            24 =>
                [
                    'id' => AlertType::USER_STATUS_REGIONAL_REPRESENTATIVE,
                    'message_ru' => 'Оплата статуса "Региональный представитель"',
                    'message_en' => 'Payment for the "Regional Representative" status',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            25 =>
                [
                    'id' => AlertType::USER_STATUS_REGIONAL_REPRESENTATIVE_REJECTED,
                    'message_ru' => 'Возврат средств за заявку на статус "Региональный представитель" при отказе',
                    'message_en' => 'Refunds for an application for the "Regional Representative" status in case of refusal',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            26 =>
                [
                    'id' => AlertType::LEADERSHIP_BONUS,
                    'message_ru' => 'Лидерский бонус',
                    'message_en' => 'Leadership bonus',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            27 =>
                [
                    'id' => AlertType::EXCHANGE,
                    'message_ru' => 'Валютообмен между балансами',
                    'message_en' => 'Currency exchange between balances',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            28 => [
                'id' => 32,
                'message_ru' => 'Отправка денежного перевода',
                'message_en' => 'Sending money transfer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            29 => [
                'id' => 33,
                'message_ru' => 'Получение денежного перевода',
                'message_en' => 'Receiving money transfer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            30 => [
                    'id' => AlertType::INVITE_REF_DEPOSIT,
                    'message_ru' => 'Отправка инвайта',
                    'message_en' => 'Sending an invite',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ],
            31 => [
                'id' => 35,
                'message_ru' => 'Покупка места на карте партнеров (30 дней)',
                'message_en' => 'Buying a place on the partner map (30 days)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            32 => [
                'id' => 36,
                'message_ru' => 'Возврат денег за размещение на карте партнеров',
                'message_en' => 'Refund for placement on partners\' map',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            33 => [
                'id' => 37,
                'message_ru' => 'Возврат незачисленных 2% по линейной партнерской программе',
                'message_en' => 'Refund of not credited 2% under the linear affiliate program',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            34 => [
                'id' => AlertType::INVITE_RESET_DEPOSIT,
                'message_ru' => 'Отмена инвайта',
                'message_en' => 'Reset an invite',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            35 => [
                'id' => AlertType::INVITE_OPEN_DEPOSIT,
                'message_ru' => 'Открытие инвайта',
                'message_en' => 'Opening an invite',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            36 => [
                'id' => AlertType::DINWAY_WALLET_DEBT_USD_WITHDRAWAL,
                'message_ru' => 'Перевод денег с Dinway колешлька на основной баланс',
                'message_en' => 'Transferring money from Dinway carriage to the main balance',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            37 => [
                'id' => AlertType::ACCOUNT_VERIFY,
                'message_ru' => 'Аккаунт прошел процедуру верификации',
                'message_en' => 'Account verified',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            38 => [
                'id' => AlertType::ACCOUNT_NOT_VERIFY,
                'message_ru' => 'В верификации аккаунта отказано.',
                'message_en' => 'Account verification denied.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],


        ]);

        echo "Rows: $rows\n";
    }
}
