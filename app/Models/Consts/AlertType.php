<?php

namespace App\Models\Consts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

/**
 * App\Models\Consts\AlertType
 *
 * @property int $id
 * @property string $message_ru
 * @property string $message_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\AlertType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\AlertType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\AlertType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\AlertType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\AlertType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\AlertType whereMessageEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\AlertType whereMessageRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\AlertType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AlertType extends Model
{
    /**
     * Возвращает сообщение типа алерта в зависимости от языка.
     *
     * @return mixed
     */
    public function alertTypeName()
    {
        return $this->{ 'message_' . Lang::locale() };
    }

    /**
     * @var "пополнение счёта"
     */
    const REPLANISHMENT_ACCOUNT = 1;

    /**
     * @var "вывод средств"
     */
    const WITHDRAWAL = 2;

    /**
     * @var "открытие инвестиционной линии"
     */
    const OPENING_INVESTMENT = 3;

    /**
     * @var "начисление ежедневной прибыли по инвестиционной линии"
     */
    const ACCRUAL_OF_DAILY_INVESTMENT = 4;

    /**
     * @var "окончание инвестиционной линии через 24 часа"
     */
    const END_OF_INVESTMENT_ONE_DAY = 5;

	/**
     * @var "окончание инвестиционной линии"
     */
    const END_OF_INVESTMENT = 6;

    /**
     * @var "регистрация нового партнёра по реф. ссылке"
     */
    const REGISTER_NEW_PARTNER = 7;

    /**
     * @var "начисление реферальной прибыли"
     */
    const ACCRUAL_OF_REFERRAL_PROFIT = 8;

    /**
     * @var "пополнение счёта партнёром"
     */
    const PARTNER_REPLENISHMENT = 9;

    /**
     * @var "начисление ежедневного процента на остаток на балансе"
     */
    const DEPOSIT_PROCENT = 10;

    /**
     * @var "начисление бонусов"
     */
    const ACCRUAL_OF_BONUSES = 11;

    /**
     * @var "начисление ежедневного процента на остаток на балансе"
     */
    const INVEST_COIN_REQUEST = 12;

    /**
     * @var "начисление бонусов"
     */
    const INVEST_COIN = 13;

    /**
     * @var "начисление бонусов"
     */
    const INVEST_COIN_REMOVE = 14;

     /**
     * @var "начисление бонусов"
     */
    const PAYOUT_BONUS = 15;

     /**
     * @var "начисление бонусов"
     */
    const ACTIVATION_BONUS = 16;

     /**
     * @var "начисление бонусов"
     */
    const CLOSE_INVESTMENT = 17;

    /**
     * @var "Матчинг бонус"
     */
    const MATCHING_BONUS = 18;

    /**
     * @var "Вывод прибыли с пакета"
     */
    const WITHDRAW_PACKAGE_PROFIT = 19;

    /**
     * @var "Реферальный бонус Graybull"
     */
    const GRAYBULL_REFERRAL_BONUS = 20;

    /**
     * @var "Открытие ставки Graybull"
     */
    const GRAYBULL_BET_OPENING = 21;

    /**
     * @var "Выплата Graybull"
     */
    const GRAYBULL_PAYMENT = 22;

    /**
     * @var "Система"
     */
    const SYSTEM = 23;

    /**
     * @var "Покупка услуг"
     */
    const SERVICES_BUY = 24;

    /**
     * @var integer "Реферальные (BlogTime)"
     */
    const SERVICES_REFERRAL_BLOGTIME = 25;

    /**
     * @var integer "Реферальные (BusinessPack)"
     */
    const SERVICES_REFERRAL_BUSINESSPACK = 26;

    /**
     * @var integer "Реферальные (Profi Universe)"
     */
    const SERVICES_PROFI_UNIVERSE = 27;

    /**
     * @var integer "Статус пользователя Региональный представитель"
     */
    const USER_STATUS_REGIONAL_REPRESENTATIVE = 28;

    /**
     * @var integer "Статус пользователя Региональный представитель (в заявке отказано)"
     */
    const USER_STATUS_REGIONAL_REPRESENTATIVE_REJECTED = 29;

    /**
     * @var integer "Лидерский бонус"
     */
    const LEADERSHIP_BONUS = 30;

    /**
     * @var integer "Валютообмен между балансами"
     */
    const EXCHANGE = 31;

    /**
     * @var integer "Денежные переводы между пользователями"
     */
    const MONEY_TRANSFER = 32;

    /**
     * @var integer "Отправка инвайта"
     */
    const INVITE_REF_DEPOSIT = 34;

    /**
     * @var integer "Возврат незачисленных 2% по линейной партнерской программе"
     */
    // const LINEAR_RETURN_2_PERCENT = 37; занято

    /**
     * @var integer "Отмена инвайта"
     */
    const INVITE_RESET_DEPOSIT = 38;

    /**
     * @var integer "Открытие инвайта"
     */
    const INVITE_OPEN_DEPOSIT = 39;
    
    /**
     * @var integer "Перевод денег с долга (dinway кошелек) на основной счет"
     */
    const DINWAY_WALLET_DEBT_USD_WITHDRAWAL = 40;

    /**
     * @var integer "Аккаунт верифицирован"
     */
    const ACCOUNT_VERIFY = 41;
    
    /**
     * @var integer "Аккаунт НЕ верифицирован (отказ)"
     */
    const ACCOUNT_NOT_VERIFY = 42;

}
