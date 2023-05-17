<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Home{
/**
 * App\Models\Home\News
 *
 * @property int $id
 * @property string $header_ru Заголовок новости
 * @property string $header_en
 * @property string $header_de
 * @property string $header_zh
 * @property string $header_pl
 * @property string $header_fr
 * @property string|null $short_description_ru Краткое описание новости
 * @property string|null $short_description_en
 * @property string|null $short_description_de
 * @property string|null $short_description_zh
 * @property string|null $short_description_pl
 * @property string|null $short_description_fr
 * @property string $text_ru Текст новости
 * @property string $text_en
 * @property string $text_de
 * @property string $text_zh
 * @property string $text_pl
 * @property string $text_fr
 * @property string|null $thumb
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\News onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereHeaderDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereHeaderEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereHeaderFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereHeaderPl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereHeaderRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereHeaderZh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereShortDescriptionDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereShortDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereShortDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereShortDescriptionPl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereShortDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereShortDescriptionZh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereTextDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereTextEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereTextPl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereTextRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereTextZh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\News withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\News withoutTrashed()
 */
	class News extends \Eloquent implements \Spatie\MediaLibrary\HasMedia\HasMedia {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\ArbitrageTradingPlan
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ArbitrageTradingPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ArbitrageTradingPlan newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\ArbitrageTradingPlan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ArbitrageTradingPlan query()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\ArbitrageTradingPlan withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\ArbitrageTradingPlan withoutTrashed()
 */
	class ArbitrageTradingPlan extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\Transaction
 *
 * @property int $id
 * @property int $user_id id пользователя-владельца транзакции.
 * @property int $transaction_type_id id типа транзакции.
 * @property int|null $wallet_id id кошелька, участвующего в транзакции.
 * @property float|null $amount_crypto Суммма операции в валюте currency_id.
 * @property float $amount_usd Сумма операции в usd по курсу rate.
 * @property float $amount_eth
 * @property float $amount_btc
 * @property float $amount_pzm
 * @property float|null $rate Курс операции (валюты currency_id к rate).
 * @property float $commission Комиссия операции (сумма операции указана без комиссии).
 * @property float $balance_usd_after_transaction Баланс пользователя после выполнения данной транзакции.
 * @property float $balance_eth_after_transaction
 * @property float $balance_btc_after_transaction
 * @property float $balance_pzm_after_transaction
 * @property float|null $percent Процент транзакции (начисления, комиссии и т.п.)
 * @property float|null $percent_on_amount От какой суммы брался процент.
 * @property int|null $line_number В транзакциях прибылях от партнеров - хранение линии с которой был доход
 * @property string|null $end_period Дата до которой нельзя выводить средства (т.е. до которой средства не доступны).
 * @property int|null $related_user_id id, связанного с транзакций пользователя.
 * @property int|null $related_user_wallet_id Связанный виртуальный криптокошелек.
 * @property int|null $editor_id id пользователя, выполнившего правки.
 * @property int|null $currency_id
 * @property string|null $comment
 * @property int $manual Транзакция создана вручную.
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Home\Currency|null $currency
 * @property-read \App\Models\User|null $editorUser
 * @property-read \App\Models\User|null $relatedUser
 * @property-read \App\Models\Home\TransactionType $transactionType
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Home\Wallet|null $wallet
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction activeUser()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Transaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction realAndNotDeletedUsers($start, $end, $transaction_types)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereAmountBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereAmountCrypto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereAmountEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereAmountPzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereAmountUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereBalanceBtcAfterTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereBalanceEthAfterTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereBalancePzmAfterTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereBalanceUsdAfterTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereEditorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereEndPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereLineNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereManual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction wherePercentOnAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereRelatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereRelatedUserWalletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereTransactionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Transaction whereWalletId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Transaction withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Transaction withoutTrashed()
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\UserMarketingPlan
 *
 * @property int $id
 * @property int $user_id id маркетингового плана
 * @property int $marketing_plan_id id маркетингового плана
 * @property float $invested_usd Инвестированная в план сумма
 * @property float $invested_eth
 * @property float $invested_btc
 * @property float $invested_pzm
 * @property float $balance_usd Текущий баланс на маркетинговом плане
 * @property float $balance_eth
 * @property float $balance_btc
 * @property float $balance_pzm
 * @property float $profit_usd Полученная прибыль
 * @property float $profit_eth
 * @property float $profit_btc
 * @property float $profit_pzm
 * @property float $rate курс
 * @property float $partner_profit_usd Полученная прибыль по партнерской программе (по доходу партнера)
 * @property float $coin_usd Сумма на балансе коина
 * @property \Illuminate\Support\Carbon $start_at Дата начала действия плана
 * @property string|null $end_at Дата окончания действия плана
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $days_left Остаток дней работі инвест плана
 * @property-read \App\Models\Home\MarketingPlan $marketingPlan
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereBalanceBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereBalanceEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereBalancePzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereBalanceUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereCoinUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereDaysLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereInvestedBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereInvestedEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereInvestedPzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereInvestedUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereMarketingPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan wherePartnerProfitUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereProfitBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereProfitEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereProfitPzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereProfitUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserMarketingPlan whereUserId($value)
 */
	class UserMarketingPlan extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\Wallet
 *
 * @property int $id
 * @property int $user_id id пользователя
 * @property int $currency_id id криптовалюты
 * @property string $address Адрес кошелька.
 * @property string|null $additional_data Дополнительные данные кошелька.
 * @property int $wallet_type_id id типа кошелька
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Home\Currency $currency
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Wallet onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereAdditionalData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Wallet whereWalletTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Wallet withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Wallet withoutTrashed()
 */
	class Wallet extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\MarketingPlanPartner
 *
 * @property int $id
 * @property int $user_id
 * @property int $partner_id
 * @property float|null $invested_usd
 * @property float $invested_eth
 * @property float $invested_btc
 * @property float $invested_pzm
 * @property float|null $profit
 * @property float $rate курс
 * @property int|null $line_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereInvestedBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereInvestedEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereInvestedPzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereInvestedUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereLineNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner wherePartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartner whereUserId($value)
 */
	class MarketingPlanPartner extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\Ipn
 *
 * @property int $id
 * @property int $wallet_id id кошелька, участвующего в транзакции.
 * @property string $address Кошелек, на который были переведены средства.
 * @property string|null $dest_tag
 * @property float $amount Сумма в криптовалюте.
 * @property int $confirms Количество подтверждений.
 * @property string $currency Обозначение криптовалюты.
 * @property float $fiat_amount Сумма в фиатных деньгах по курсу.
 * @property string $fiat_coin Обозначение фиатных денег.
 * @property string $ipn_id id IPN
 * @property string $merchant id merchant
 * @property int $status Статус транзакции.
 * @property string $status_text Текст статуса транзакции.
 * @property string $txn_id Хэш транзакции.
 * @property string $request_data Весь post-запрос.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereConfirms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereDestTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereFiatAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereFiatCoin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereIpnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereMerchant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereRequestData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereStatusText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereTxnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Ipn whereWalletId($value)
 */
	class Ipn extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\MotivationPlan
 *
 * @property int $id
 * @property string $name Название плана
 * @property float $price Цена плана
 * @property float $min_invest_sum Минимально инвестированная сумма для покупки плана
 * @property float $min_balance Минимальный баланс для покупки плана
 * @property float $min_withdrawal Минимальный вывод
 * @property float $withdrawal_commission_percent Комиссия вывода, %
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Home\MotivationPlanParam[] $params
 * @property-read int|null $params_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MotivationPlan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereMinBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereMinInvestSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereMinWithdrawal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlan whereWithdrawalCommissionPercent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MotivationPlan withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MotivationPlan withoutTrashed()
 */
	class MotivationPlan extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\BalanceType
 *
 * @property int $id
 * @property string|null $comment Комментарий
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Home\BalanceTypeTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Home\BalanceTypeTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType orWhereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType whereTranslation($translationField, $value, $locale = null, $method = 'whereHas', $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType whereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceType withTranslation()
 */
	class BalanceType extends \Eloquent implements \Astrotomic\Translatable\Contracts\Translatable {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\MarketingPlanPartnerProgram
 *
 * @property int $id
 * @property int $marketing_plan_id id маркетингового плана
 * @property int $partner_program_id id партнерской программы (id: 1 - от прибыли партнеров; 2 - от инвестиции партнеров)
 * @property int $line_number Номер линии маркетингового плана
 * @property float $profit % прибыли
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram whereLineNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram whereMarketingPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram wherePartnerProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlanPartnerProgram whereUpdatedAt($value)
 */
	class MarketingPlanPartnerProgram extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\Alert
 *
 * @property int $id
 * @property int $user_id
 * @property int $alert_id
 * @property string|null $email
 * @property float|null $amount
 * @property int|null $currency_id
 * @property int $status
 * @property string $currency_type
 * @property int|null $marketing_plan_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Home\Currency|null $currency
 * @property-read \App\Models\Home\MarketingPlan|null $marketing_plan
 * @property-read \App\Models\Consts\AlertType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereAlertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereCurrencyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereMarketingPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Alert whereUserId($value)
 */
	class Alert extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\Bonus
 *
 * @property int $id
 * @property int $level Уровни
 * @property float $bonus Бонус
 * @property float $personal_deposit Личный депозит
 * @property float $team_turnover Оборот 1-й линии
 * @property float $invitation_deposit Пригласительный депозит
 * @property float $matching_bonus Матчинг бонус
 * @property int $affiliate_magnet Партнёрский магнит
 * @property int $fast_start Быстрый старт
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereAffiliateMagnet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereFastStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereInvitationDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereMatchingBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus wherePersonalDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereTeamTurnover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Bonus whereUpdatedAt($value)
 */
	class Bonus extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\ArbitrageTrading
 *
 * @property-read \App\Models\Home\CryptocurrencyExchange $buyCryptocurrencyExchange
 * @property-read \App\Models\Home\Currency $currency
 * @property-read \App\Models\Home\CryptocurrencyExchange $sellCryptocurrencyExchange
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ArbitrageTrading newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ArbitrageTrading newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\ArbitrageTrading onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ArbitrageTrading query()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\ArbitrageTrading withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\ArbitrageTrading withoutTrashed()
 */
	class ArbitrageTrading extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\CryptocurrencyExchange
 *
 * @property int $id
 * @property string $name Название биржи
 * @property string $sub_uri Часть ссылки, обозначающая биржу для чтения курсов
 * @property int $in_arbitrage_trading Флаг, что биржа участвует в арбитражной торговле
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\CryptocurrencyExchange onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange whereInArbitrageTrading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange whereSubUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\CryptocurrencyExchange whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\CryptocurrencyExchange withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\CryptocurrencyExchange withoutTrashed()
 */
	class CryptocurrencyExchange extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\MarketingPlan
 *
 * @property int $id
 * @property string $name Название плана
 * @property string $currency_type
 * @property float $min_invest_sum Минимальная сумма инвестирования в пакет
 * @property float $max_invest_sum Максимальная сумма инвестирования в пакет
 * @property int $min_duration Минимальная длительность работы депозита
 * @property int $max_duration Максимальная длительность работы депозита
 * @property int $first_days_count_for_simple_percent Кол-во первых дней, когда начисляются простые проценты.
 * @property float|null $daily_percent
 * @property int $only_business_days Признак, что начислять только в рабочие дни
 * @property float $min_profit Минимальная прибыль
 * @property float $max_profit Максимальная прибыль в день
 * @property float|null $manual_percent Процент следующих начислений, указанный вручную.
 * @property float $min_withdrawal_request Ограничение на создание заявки на вывод при активном плане
 * @property float $coin_percent % прибыли, который переводится на счет коина
 * @property int $available_for_withdrawal Доступно к выводу
 * @property float|null $withdrawal_commission Комиссия на вывод
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Home\MarketingPlan $marketingPlan
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MarketingPlan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereAvailableForWithdrawal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereCoinPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereCurrencyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereDailyPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereFirstDaysCountForSimplePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereManualPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereMaxDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereMaxInvestSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereMaxProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereMinDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereMinInvestSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereMinProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereMinWithdrawalRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereOnlyBusinessDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MarketingPlan whereWithdrawalCommission($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MarketingPlan withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MarketingPlan withoutTrashed()
 */
	class MarketingPlan extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\MotivationPlanParam
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlanParam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlanParam newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MotivationPlanParam onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\MotivationPlanParam query()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MotivationPlanParam withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\MotivationPlanParam withoutTrashed()
 */
	class MotivationPlanParam extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\GlobalStatistics
 *
 * @property int $id
 * @property string $name Название параметра
 * @property string $value Значение параметра
 * @property string|null $comment Комментарий
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\GlobalStatistics whereValue($value)
 */
	class GlobalStatistics extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\Balance
 *
 * @property int $id
 * @property int $user_id id пользователя
 * @property int $balance_type_id id типа баланса
 * @property float $balance Сумма баланса
 * @property int $currency_id id валюты баланса
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance whereBalanceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Balance whereUserId($value)
 */
	class Balance extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\Rate
 *
 * @property int $id
 * @property int $currency_id id валюты
 * @property float $rate Курс валюты к доллару.
 * @property float $trend % изменения курса за последние сутки.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Home\Currency $currency
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate whereTrend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Rate whereUpdatedAt($value)
 */
	class Rate extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\BauntyLink
 *
 * @property int $id
 * @property int $user_id
 * @property int $package_id
 * @property string $link
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Home\BauntyPackages $package
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\BauntyLink onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyLink whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\BauntyLink withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\BauntyLink withoutTrashed()
 */
	class BauntyLink extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\Currency
 *
 * @property int $id
 * @property string $name Название валюты.
 * @property string $code Обозначение валюты.
 * @property int $rate_decimal_digits Кол-во десятичных разрядов в курсе валюты.
 * @property int $invest_allowed Разрешено использовать для ввода.
 * @property int $withdrawal_allowed Разрешено использовать для вывода.
 * @property int $show_rate_on_landing Признак, надо или нет показывать этот курс на лендинге.
 * @property int $is_crypto Признак, что это криптовалюта. Пошли костыли, чтобы подключить плат. системы.
 * @property int $in_arbitrage_trading Признак, что криптовалюта доступна в арбитражной торговле.
 * @property string|null $blockchain_addr Адрес блокчена для проверки транзакции.
 * @property float $withdrawal_commission
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency allowedForWithdrawalCrypto()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency allowedForWithdrawalPaymentSystems()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Currency onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereBlockchainAddr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereInArbitrageTrading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereInvestAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereIsCrypto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereRateDecimalDigits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereShowRateOnLanding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereWithdrawalAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Currency whereWithdrawalCommission($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Currency withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\Currency withoutTrashed()
 */
	class Currency extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\UserReferralsUsd
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserReferralsUsd newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserReferralsUsd newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserReferralsUsd query()
 */
	class UserReferralsUsd extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\BauntyPackages
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyPackages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyPackages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyPackages query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyPackages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyPackages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyPackages whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BauntyPackages whereUpdatedAt($value)
 */
	class BauntyPackages extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\UserPaymentDetail
 *
 * @property int $id
 * @property int $user_id id пользователя
 * @property int $currency_id id криптовалюты (по факту - платежной системы)
 * @property string $address Адрес кошелька (по факту - реквизиты плат. сист.)
 * @property string|null $additional_data Дополнительные данные плат. сист.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $transaction_id id транзакции
 * @property-read \App\Models\Home\Currency $currency
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\UserPaymentDetail onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereAdditionalData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\UserPaymentDetail whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\UserPaymentDetail withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Home\UserPaymentDetail withoutTrashed()
 */
	class UserPaymentDetail extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\TransactionType
 *
 * @property int $id
 * @property string $name_ru Название типа транзакции.
 * @property string $name_en
 * @property string $name_de
 * @property string $name_zh
 * @property string $name_fr
 * @property string $name_pl
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereNameDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereNamePl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereNameZh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\TransactionType whereUpdatedAt($value)
 */
	class TransactionType extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\Baunty
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $text
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\Baunty whereUpdatedAt($value)
 */
	class Baunty extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\VerifyWithdrawal
 *
 * @property int $id
 * @property int $user_id
 * @property int $currency_id
 * @property string $token
 * @property float|null $amount
 * @property string $address
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Home\Currency $currency
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\VerifyWithdrawal whereUserId($value)
 */
	class VerifyWithdrawal extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\BalanceTypeTranslation
 *
 * @property int $id
 * @property int $balance_type_id
 * @property string $locale
 * @property string $name Название типа баланса на языке, заданном в поле locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceTypeTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceTypeTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceTypeTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceTypeTranslation whereBalanceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceTypeTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceTypeTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\BalanceTypeTranslation whereName($value)
 */
	class BalanceTypeTranslation extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\OutgoingPayments
 *
 * @property int $id
 * @property int $user_id id пользователя
 * @property string $received_at Дата получения средств
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments whereReceivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\OutgoingPayments whereUserId($value)
 */
	class OutgoingPayments extends \Eloquent {}
}

namespace App\Models\Home{
/**
 * App\Models\Home\ReferralAccrualParam
 *
 * @property int $id
 * @property int $level Уровень реферала.
 * @property int $transaction_type_id id типа транзакции
 * @property int $percent Процент от дохода реферала конкретного уровня, который получает рефер.
 * @property int $accrue Надо ли начислять прибыль по данному уровню.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam whereAccrue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam whereTransactionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Home\ReferralAccrualParam whereUpdatedAt($value)
 */
	class ReferralAccrualParam extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PasswordSecurity
 *
 * @property int $id
 * @property int $user_id
 * @property int $google2fa_enable
 * @property string|null $google2fa_secret
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity whereGoogle2faEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity whereGoogle2faSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordSecurity whereUserId($value)
 */
	class PasswordSecurity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WithdrawVerification
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawVerification whereUserId($value)
 */
	class WithdrawVerification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Param
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Param newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Param newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Param query()
 */
	class Param extends \Eloquent {}
}

namespace App\Models\Admin{
/**
 * App\Models\Admin\Config
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Config newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Config newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Config query()
 */
	class Config extends \Eloquent {}
}

namespace App\Models\Admin{
/**
 * App\Models\Admin\Accrual
 *
 * @property int $id
 * @property float $percent Начисленный процент
 * @property float|null $percent_month Месячный процент
 * @property string|null $meta Дополнительные данные начисления.
 * @property string $start Начали начисления
 * @property string $end Закончили начисления
 * @property string|null $comment Комментарий к начислению.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual wherePercentMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Accrual whereUpdatedAt($value)
 */
	class Accrual extends \Eloquent {}
}

namespace App\Models\Admin{
/**
 * App\Models\Admin\ReferralAccrualParam
 *
 * @property int $id
 * @property int $level Уровень реферала.
 * @property int $transaction_type_id id типа транзакции
 * @property int $percent Процент от дохода реферала конкретного уровня, который получает рефер.
 * @property int $accrue Надо ли начислять прибыль по данному уровню.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam whereAccrue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam whereTransactionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\ReferralAccrualParam whereUpdatedAt($value)
 */
	class ReferralAccrualParam extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $locale Локализация пользователя.
 * @property string $email
 * @property string|null $google_id Google ID
 * @property string|null $phone Телефон пользователя
 * @property float $replenishment все пополнения
 * @property float $balance_usd Текущий баланс.
 * @property float $balance_eth
 * @property float $balance_btc
 * @property float $balance_pzm
 * @property float $invested_usd Общая инвестированная сумма.
 * @property float $invested_eth
 * @property float $invested_btc
 * @property float $invested_pzm
 * @property float $marketplace_purchased_shares Куплено долей маркетплейса
 * @property float $invested_usd_to_marketplace Сколько всего пользователь инвестировал в маркетплейс.
 * @property float $invested_eth_to_marketplace
 * @property float $invested_btc_to_marketplace
 * @property float $invested_pzm_to_marketplace
 * @property float $profit_usd Общая заработанная сумма.
 * @property float $profit_eth
 * @property float|null $profit_btc
 * @property float $profit_pzm
 * @property float $referrals_usd Сумма, заработанная на рефералах.
 * @property float $referrals_eth
 * @property float $referrals_btc
 * @property float $referrals_pzm
 * @property float $withdrawal_usd Сумма, выведенная пользователем.
 * @property float $withdrawal_eth
 * @property float $withdrawal_btc
 * @property float $withdrawal_pzm
 * @property float $withdrawal_request_usd Сумма заявок на вывод.
 * @property float $bonuses_usd Сумма начисленных бонусов
 * @property int $bonus_level Уровень бонусы
 * @property float $bonuses_deposit Бонусный депозит
 * @property int|null $accrual_currency_id id криптовалюты в которой выполнять начисления
 * @property int|null $parent_id id пользователя, по реферальной ссылке которого пришел пользователь
 * @property int|null $right_id
 * @property int $left_id
 * @property string|null $ref_code Реферальная ссылка пользователя
 * @property string|null $exchange_name Название биржи.
 * @property string|null $api_key API-ключи пользвателя для управления на бирже.
 * @property string|null $visa Реквизиты Visa
 * @property string|null $mastercard Реквизиты Mastercard
 * @property string|null $qiwi Реквизиты Qiwi
 * @property string|null $webmoney Реквизиты Webmoney
 * @property string|null $yandexMoney Реквизиты Yandex Money
 * @property int $is_trading_account Признак трейдинг-аккаунта (на котором доступна арбитражная торговля)
 * @property int|null $motivation_plan_id id типа мотивационного плана
 * @property string|null $motivation_plan_start_at Дата начала действия мотивационного плана
 * @property float $last_marketing_plan_profit Сумма последнего начисления по маркетинг-плану (для оптимизации вычисления прибыли от линии)
 * @property int $admin Признак админа.
 * @property int $fake Признак фейковости пользователя
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $email_reset_token Токен сброса email
 * @property string|null $new_email Новый email
 * @property string|null $remember_token
 * @property int|null $editor_id id пользователя, выполнившего правки.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $country Страна пользователя
 * @property int|null $age Возраст
 * @property string|null $add_contact Дополнительный контакт
 * @property-read \App\Models\User|null $ancestor
 * @property-read \App\Models\Home\ArbitrageTradingPlan $arbitrageTradingPlan
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\User[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Home\MarketingPlan|null $marketingPlan
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Home\MotivationPlan|null $motivationPlan
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\User|null $parent
 * @property-read \App\Models\PasswordSecurity|null $passwordSecurity
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\User[] $refferrals
 * @property-read int|null $refferrals_count
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\User[] $refferralsLastMonth
 * @property-read int|null $refferrals_last_month_count
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\User[] $refferralsThisMonth
 * @property-read int|null $refferrals_this_month_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Home\UserMarketingPlan[] $userActiveMarketingPlans
 * @property-read int|null $user_active_marketing_plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Home\UserMarketingPlan[] $userAllMarketingPlans
 * @property-read int|null $user_all_marketing_plans_count
 * @property-read \App\Models\Home\UserMarketingPlan|null $userMarketingPlan
 * @property-read \App\Models\Home\UserMarketingPlan|null $userMarketingPlan2
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Home\UserMarketingPlan[] $userMarketingPlans
 * @property-read int|null $user_marketing_plans_count
 * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User d()
 * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|\App\Models\User newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User onlyTrashed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAccrualCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAddContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBalanceBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBalanceEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBalancePzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBalanceUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBonusLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBonusesDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBonusesUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEditorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailResetToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereExchangeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFake($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereInvestedBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereInvestedBtcToMarketplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereInvestedEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereInvestedEthToMarketplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereInvestedPzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereInvestedPzmToMarketplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereInvestedUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereInvestedUsdToMarketplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIsTradingAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastMarketingPlanProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLeftId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereMarketplacePurchasedShares($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereMastercard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereMotivationPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereMotivationPlanStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNewEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereProfitBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereProfitEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereProfitPzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereProfitUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereQiwi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRefCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereReferralsBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereReferralsEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereReferralsPzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereReferralsUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereReplenishment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRightId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereVisa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWebmoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWithdrawalBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWithdrawalEth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWithdrawalPzm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWithdrawalRequestUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWithdrawalUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereYandexMoney($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withoutTrashed()
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Translation\HasLocalePreference, \Illuminate\Contracts\Auth\MustVerifyEmail, \Spatie\MediaLibrary\HasMedia\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\Job
 *
 * @property int $id
 * @property string $queue
 * @property string $payload
 * @property int $attempts
 * @property int|null $reserved_at
 * @property int $available_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property int|null $user_id id связанного с задачей пользователя
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereAvailableAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereQueue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereReservedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereUserId($value)
 */
	class Job extends \Eloquent {}
}

namespace App\Models\Consts{
/**
 * App\Models\Consts\GlobalStatisticsConstants
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\GlobalStatisticsConstants newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\GlobalStatisticsConstants newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\GlobalStatisticsConstants query()
 */
	class GlobalStatisticsConstants extends \Eloquent {}
}

namespace App\Models\Consts{
/**
 * App\Models\Consts\TransactionsTypesConsts
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\TransactionsTypesConsts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\TransactionsTypesConsts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\TransactionsTypesConsts query()
 */
	class TransactionsTypesConsts extends \Eloquent {}
}

namespace App\Models\Consts{
/**
 * App\Models\Consts\WalletsStatusesConsts
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\WalletsStatusesConsts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\WalletsStatusesConsts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\WalletsStatusesConsts query()
 */
	class WalletsStatusesConsts extends \Eloquent {}
}

namespace App\Models\Consts{
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
 */
	class AlertType extends \Eloquent {}
}

namespace App\Models\Consts{
/**
 * App\Models\Consts\WalletsTypesConsts
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\WalletsTypesConsts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\WalletsTypesConsts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\WalletsTypesConsts query()
 */
	class WalletsTypesConsts extends \Eloquent {}
}

namespace App\Models\Consts{
/**
 * App\Models\Consts\CurrencyConstants
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\CurrencyConstants newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\CurrencyConstants newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\CurrencyConstants query()
 */
	class CurrencyConstants extends \Eloquent {}
}

namespace App\Models\Consts{
/**
 * App\Models\Consts\BalanceTypeConstants
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\BalanceTypeConstants newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\BalanceTypeConstants newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consts\BalanceTypeConstants query()
 */
	class BalanceTypeConstants extends \Eloquent {}
}

