<?php

namespace App\Models\Consts;

use Illuminate\Database\Eloquent\Model;

/**
 * Константы таблицы transactions_types
 *
 * Class TransactionsTypesConsts
 *
 * @package App\Models\Consts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\TransactionsTypesConsts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\TransactionsTypesConsts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\TransactionsTypesConsts query()
 * @mixin \Eloquent
 */
class TransactionsTypesConsts extends Model
{
    // todo-y Надо в базе тоже транзакции чуток переимновать, чтобы не слово в слово, как было (если названия типов транзакций будет где-то выводиться)
    /**
     * @var integer id типа транзкции "Ввод средств"
     */
    const INVEST_TYPE_ID = 1;

    /**
     * @var integer id типа транзкции "Прибыль от маркетингового плана"
     */
    const PROFIT_TYPE_ID = 2;

    /**
     * @var integer id типа транзкции "Реферальные ур. 1"
     */
    const REFERRALS_L1_TYPE_ID = 3;

    /**
     * @var integer id типа транзкции "Реферальные ур. 2"
     */
    const REFERRALS_L2_TYPE_ID = 4;

    /**
     * @var integer id типа транзкции "Реферальные ур. 3"
     */
    const REFERRALS_L3_TYPE_ID = 5;

    /**
     * @var integer id типа транзкции "Реферальные ур. 4"
     */
    const REFERRALS_L4_TYPE_ID = 6;

    /**
     * @var integer id типа транзкции "Реферальные ур. 5"
     */
    const REFERRALS_L5_TYPE_ID = 7;

    /**
     * @var integer id типа транзкции "Реферальные ур. 6"
     */
    const REFERRALS_L6_TYPE_ID = 8;

    /**
     * @var integer id типа транзкции "Реферальные ур. 7"
     */
    const REFERRALS_L7_TYPE_ID = 9;

    /**
     * @var integer id типа транзкции "Реферальные ур. 8"
     */
    const REFERRALS_L8_TYPE_ID = 10;

    /**
     * @var integer id типа транзкции "Реферальные ур. 9"
     */
    const REFERRALS_L9_TYPE_ID = 11;

    /**
     * @var integer id типа транзкции "Реферальные ур. 10"
     */
    const REFERRALS_L10_TYPE_ID = 12;

    /**
     * @var integer id типа транзкции "Заявка на вывод"
     */
    const WITHDRAWAL_REQUEST_TYPE_ID = 13;

    /**
     * @var integer id типа транзкции "Вывод"
     */
    const WITHDRAWAL_TYPE_ID = 14;

    /**
     * @var integer id типа транзкции "Бонус"
     */
    const BONUSES_TYPE_ID = 15;

    /**
     * @var integer id типа транзкции "Доход арбитражной торговли"
     */
    const ARBITRAGE_TRADING_INCOME_TYPE_ID = 18;

    /**
     * @var integer id типа транзкции "Покупка арбитражного плана торговли"
     */
    const BUY_ARBITRAGE_TRADING_PLAN_TYPE_ID = 19;

    /**
     * @var integer id типа транзкции "Бонус за покупку арбитражного плана рефералом"
     */
    const BONUS_FOR_REFERRAL_BUY_ARBITRAGE_PLAN_TYPE_ID = 20;

    /**
     * @var integer id типа транзкции "Покупка плана новой системы мотивации"
     */
    const BUY_NEW_MOTIVATION_PLAN_ID = 21;

    /**
     * @var integer id типа транзкции "Бонусы по депозиту по новой системе мотивации"
     */
    const DEPOSIT_BONUSES_NEW_MOTIVATION_TYPE_ID = 22;

    /**
     * @var integer id типа транзкции "Бонусы за рефералов по новой системе мотивации"
     */
    const REFERRALS_BONUSES_NEW_MOTIVATION_TYPE_ID = 23;

    /**
     * @var integer id типа транзкции "Перевод средств между аккаунтами"
     */
    const TRANSFER_BETWEEN_ACCOUNTS_TYPE_ID = 24;

    /**
     * @var integer id типа транзкции "Перевод между основным счетом и криптоколешьками"
     */
    const TRANSFER_CRYPTO_WALLETS_TYPE_ID = 25;

    /**
     * @var integer id типа транзкции "Прибыль в криптовалюте"
     */
    const DEPOSIT_PROFIT_IN_CRYPTO_TYPE_ID = 26;

    /**
     * @var integer id типа транзкции "Инвестиции в маркетплейс"
     */
    const INVEST_TO_MARKETPLACE_TYPE_ID = 27;

    /**
     * @var integer id типа транзкции "Инвестиции в маркетинг с основного баланса"
     */
    const INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE = 29;

    /**
     * @var integer id типа транзкции "Инвестиции в маркетинг с баланса коина"
     */
    const INVEST_TO_MARKETING_PLAN_FROM_COIN_BALANCE = 30;

    /**
     * @var integer id типа транзкции "Прибыль от партнерской программы"
     */
    const PROFIT_FROM_PARTNER_PROGRAM = 32;

    /**
     * @var integer id типа транзкции "Перевод тела с маркетингового плана на основной счет"
     */
    const TRANSFER_BODY_FROM_MARKETING_PLAN_TO_MAIN_BALANCE = 33;

    /**
     * @var integer id типа транзкции "Депозитный процент"
     */
    const DEPOSIT_PROCENT = 34;

    /**
     * @var integer id типа транзкции "Депозитный процент"
     */
    const ACCRUED_THROUGH_ADMIN = 35;

    /**
     * @var integer id типа транзкции "Заявка на вывод"
     */
    const INVEST_COIN_REQUEST_TYPE_ID = 36;

    /**
     * @var integer id типа транзкции "Вывод"
     */
    const INVEST_COIN_TYPE_ID = 37;

    /**
     * @var integer id типа транзкции "Матчинг бонус"
     */
    const MATCHING_BONUS = 38;

    /**
     * @var integer id типа транзкции "Открытие ставки Graybull"
     */
    const GRAYBULL_BET_OPENING = 39;

    /**
     * @var integer id типа транзкции "Выплата Graybull"
     */
    const GRAYBULL_PAYMENT = 40;

    /**
     * @var integer id типа транзкции "Реферальный бонус Graybull"
     */
    const GRAYBULL_REFERRAL_BONUS = 41;

    /**
     * @var integer id типа транзкции "Система"
     */
    const SYSTEM = 42;

    /**
     * @var integer id типа транзкции "Покупка услуг"
     */
    const BUY_SERVICES = 43;

    /**
     * @var integer "Бонус от реферала купившего услугу"
     */
    const SERVICES_REFERRAL_BONUS = 44;

    /**
     * @var integer "Оборот первого уровня за покупку услуги"
     */
    const SERVICES_REFERRAL_ONE_LINE = 45;

    /**
     * @var integer "Оборот первого уровня за покупку услуги"
     */
    const SERVICES_REFERRAL_TEAM_TURNOVER = 46;

    /**
     * @var integer id типа транзкции "Статус пользователя Региональный представитель"
     */
    const USER_STATUS_REGIONAL_REPRESENTATIVE = 47;

    /**
     * @var integer id типа транзкции "Статус пользователя Региональный представитель (в заявке отказано)"
     */
    const USER_STATUS_REGIONAL_REPRESENTATIVE_REJECTED = 48;

    /**
     * @var integer "Лидерский бонус"
     */
    const LEADERSHIP_BONUS = 49;

    /**
     * @var integer "Валютообмен"
     */
    const EXCHANGE = 50;

    /**
     * @var integer "Пользовательский перевод (отправка)"
     */
    const USER_TRANSFER_SEND = 52;

    /**
     * @var integer "Пользовательский перевод (получение)"
     */
    const USER_TRANSFER_GET = 53;

    /**
     * @var integer "Приобретение места на карте партнеров (30 дней)"
     */
    const PARNETRS_MAP_PLACE = 54;

    /**
     * @var integer "Возврат денег за  место на карте партнеров"
     */
    const PARNETRS_MAP_REFUSE = 55;

    /**
     * @var integer "Отмена инвайта"
     */
    const INVITE_RESET_DEPOSIT = 57;

    /**
     * @var integer "Отправка инвайта"
     */
    const INVITE_REF_DEPOSIT = 58;
    /**
     * @var integer "Отправка инвайта"
     */
    const DINWAY_WALLET_DEBT_USD_WITHDRAWAL = 59;

    /**
     * @var array Массив id типов транзакций инвестиций пользователя
     */
    const ALL_INVEST_TYPES = [
        TransactionsTypesConsts::INVEST_TYPE_ID,
        TransactionsTypesConsts::BUY_ARBITRAGE_TRADING_PLAN_TYPE_ID,
        TransactionsTypesConsts::BUY_NEW_MOTIVATION_PLAN_ID,
    ];

    /**
     * @var array Массив id типов транзакций с прибылью от рефералов
     */
    const ALL_REFERRAL_PROFIT_TYPES = [
        TransactionsTypesConsts::REFERRALS_L1_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L2_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L3_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L4_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L5_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L6_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L7_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L8_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L9_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L10_TYPE_ID,
        TransactionsTypesConsts::PROFIT_FROM_PARTNER_PROGRAM,
    ];

    /**
     * @var array Массив id типов транзакций с прибылью без реферальной
     */
    const ALL_PROFIT_NOT_REF_TYPES = [
        TransactionsTypesConsts::PROFIT_TYPE_ID,
        TransactionsTypesConsts::ARBITRAGE_TRADING_INCOME_TYPE_ID,
        TransactionsTypesConsts::DEPOSIT_BONUSES_NEW_MOTIVATION_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_BONUSES_NEW_MOTIVATION_TYPE_ID,
    ];

    /**
     * @var array Массив id типов транзакций с прибылью
     */
    const ALL_PROFIT_TYPES = [
        TransactionsTypesConsts::PROFIT_TYPE_ID,
        TransactionsTypesConsts::ARBITRAGE_TRADING_INCOME_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_BONUSES_NEW_MOTIVATION_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L1_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L2_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L3_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L4_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L5_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L6_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L7_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L8_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L9_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_L10_TYPE_ID,
        TransactionsTypesConsts::ARBITRAGE_TRADING_INCOME_TYPE_ID,
        TransactionsTypesConsts::BONUS_FOR_REFERRAL_BUY_ARBITRAGE_PLAN_TYPE_ID,
        TransactionsTypesConsts::DEPOSIT_BONUSES_NEW_MOTIVATION_TYPE_ID,
        TransactionsTypesConsts::REFERRALS_BONUSES_NEW_MOTIVATION_TYPE_ID,
        /*TransactionsTypesConsts::TRANSFER_PROFIT_FROM_MARKETING_PLAN_TO_MAIN_BALANCE,*/
        TransactionsTypesConsts::PROFIT_FROM_PARTNER_PROGRAM,
    ];

    /**
     * @var array Массив id типов транзакций с инвестицией в маркетинговые планы
     */
    const MARKET_PLANS_INVEST = [
        TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE,
        TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_COIN_BALANCE,
    ];

    /**
     * @var array Массив id типов транзакций со всей прибылю в маркетинговые планы
     */
    const MARKET_PLANS_ALL_INCOME = [
        /*TransactionsTypesConsts::TRANSFER_PROFIT_FROM_MARKETING_PLAN_TO_MAIN_BALANCE,*/
        TransactionsTypesConsts::PROFIT_FROM_PARTNER_PROGRAM,
    ];
}
