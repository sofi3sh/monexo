<?php

namespace App\Console\Commands;

use App\Models\Consts\AlertType;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Alert;
use App\Models\Home\MarketingPlan;
use App\Models\Home\Transaction;
use App\Models\Home\UserMarketingPlan;
use App\Models\Home\UserWallet;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RepairAccrue extends Command
{
    /** @inheritdoc  */
    protected $signature = 'repair:accrue';

    /** @inheritdoc  */
    protected $description = 'Исправление начислений по пакетам.';

    /** @var bool */
    private $isCheckValid = false;

    /**
     * @param $userId
     */
    public function commandUpdateMatchingUser($userId)
    {
        $this->warn("[user_id: $userId] Исправление пользователя (возврат матчинг бонусов).");

        $logItems = $this->logTable()->where('user_id', $userId)->get();
        if (!$logItems->count()) {
            $this->error("[user_id: $userId] Не найдены записи для восстановления.");
            return;
        }

        $user = User::find($userId);
        if (!$user) {
            $this->error('Пользователь не найден');
            return;
        }

        $fromDatetime = $this->getDateTimeForRevert();
        $toDatetime = $this->getDateTimeForRevertEnd();

        /** @var $transactions Collection */
        $amount = Transaction::query()
            ->where(['user_id' => $userId, 'transaction_type_id' => 38])
            ->whereRaw("created_at >= '$fromDatetime' AND created_at <= '$toDatetime'")
            ->get()
            ->sum('amount_usd');

        $amount = -$amount;

        // если уже делали возврат матчинг бонуса
        $alreadyHave = Transaction::query()
            ->where([
                'user_id' => $userId,
                'transaction_type_id' => TransactionsTypesConsts::SYSTEM,
                'amount_usd' => round($amount, 2),
            ])
            ->whereRaw("created_at >= '$fromDatetime'")
            ->exists();

        if ($alreadyHave) {
            $this->warn('Пользователь ' . $userId . ' уже имеет возврат (матчинг бонус ' . $amount . '$)');
            return;
        }

        // оповещение
        $alert = new Alert();
        $alert->user_id = $user->id;
        $alert->alert_id = AlertType::SYSTEM;
        $alert->amount = $amount;
        $alert->currency_type = 'usd';
        $alert->save();

        // транзакция для обновления баланса пользователя
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->transaction_type_id = TransactionsTypesConsts::SYSTEM;
        $transaction->amount_usd = $amount;
        $transaction->balance_usd_after_transaction = $user->balance_usd + $amount;
        $transaction->save();

        $user->bonuses_usd += $amount;
        $user->save();

        $this->info('Пользователь ' . $userId . ' успешно обновлен (матчинг бонус ' . $amount . '$)');
    }

    /**
     * @return void
     */
    public function commandCreateSystemTransaction()
    {
        $this->warn('Создание системной транзакции');

        $userId = $this->ask('Укажите ID пользователя');

        $user = User::find($userId);
        if (!$user) {
            $this->error('Пользователь не найден');
            return;
        }

        $code = $this->choice('Выберите валюту для транзакции', [
            'usd',
            'btc',
            'pzm',
            'eth',
        ]);

        $amount = (float)$this->ask('Укажите сумму');

        $userBalance = $user->{'balance_' . $code};
        if ($userBalance + $amount < 0) {
            $this->error('Баланс пользователя не может быть отрицательным, текущий баланс: ' . $userBalance . strtoupper($code));
            return;
        }

        if (!$this->confirm('Баланс пользователя будет изменен на ' . $amount . strtoupper($code) . ' (текущий баланс ' . ($userBalance . strtoupper($code)) . ')' . ', баланс после изменения ' . ($userBalance + $amount) . strtoupper($code) . ', продолжить?')) {
            $this->warn('Отмена создания системной транзакции');
            return;
        }

        // оповещение
        $alert = new Alert();
        $alert->user_id = $user->id;
        $alert->alert_id = AlertType::SYSTEM;
        $alert->amount = $amount;
        $alert->currency_type = $code;
        $alert->save();

        // транзакция для обновления баланса пользователя
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->transaction_type_id = TransactionsTypesConsts::SYSTEM;
        $transaction->{'amount_' . $code} = $amount;
        $transaction->{'balance_' . $code . '_after_transaction'} = $user->{'balance_' . $code} + $amount;
        $transaction->save();

        $user->refresh();
        $this->info('Баланс пользователя изменен на ' . $amount . strtoupper($code) . ', баланс после изменений ' . $user->{'balance_' . $code} . strtoupper($code));
    }

    /**
     * @param $userId
     */
    public function commandUpdateUser($userId)
    {
        $this->warn("[user_id: $userId] Исправление пользователя.");

        $logItems = $this->logTable()->where('user_id', $userId)->get();
        if (!$logItems->count()) {
            $this->error("[user_id: $userId] Не найдены записи для восстановления.");
            return;
        }

        if ($logItems[0]->updated) {
            $this->warn("[user_id: $userId] Пользователь уже исправлен.");
            return;
        }

        $user = User::find($userId);
        if (!$user) {
            $this->error("[user_id: $userId] Такой пользователь не найден.");
            return;
        }

        DB::beginTransaction();
        $rollbackAmount = ['usd' => 0, 'btc' => 0, 'eth' => 0, 'pzm' => 0];
        try {
            // обработка каждого пакета пользователя
            foreach ($logItems as $logItem) {
                /** @var UserMarketingPlan $userPlan */
                $userPlan = UserMarketingPlan::where([
                    'id' => $logItem->user_marketing_plan_id,
                    'marketing_plan_id' => $logItem->marketing_plan_id,
                    'user_id' => $userId,
                ])->get()->first();

                if (!$userPlan) {
                    throw new \Exception("[user_id: {$userId}] Пакет {$logItem->user_marketing_plan_id} не найден, отмена обновления пользователя.");
                }

                foreach (['usd', 'btc', 'eth', 'pzm'] as $code) {
                    $logItemAmount = $logItem->{'amount_' . $code};
                    if ($logItemAmount > 0) {
                        $logItem->{'was_balance_' . $code} = $userPlan->{'balance_' . $code};
                        $logItem->{'was_profit_' . $code} = $userPlan->{'profit_' . $code};
                        // изменение суммы у пакета
                        $userPlan->{'balance_' . $code} -= $logItemAmount;
                        $userPlan->{'profit_' . $code} -= $logItemAmount;
                        // подсчет общей суммы для возрата у пользователя
                        $rollbackAmount[$code] += $logItemAmount;
                    }
                }

                $this->logTable()->where('id', $logItem->id)->update([
                    'was_balance_usd' => $logItem->was_balance_usd,
                    'was_balance_btc' => $logItem->was_balance_btc,
                    'was_balance_eth' => $logItem->was_balance_eth,
                    'was_balance_pzm' => $logItem->was_balance_pzm,

                    'was_profit_usd' => $logItem->was_profit_usd,
                    'was_profit_btc' => $logItem->was_profit_btc,
                    'was_profit_eth' => $logItem->was_profit_eth,
                    'was_profit_pzm' => $logItem->was_profit_pzm,

                    // сохранение колонок того, что было у пакета was_*
                    'was_days_left' => $userPlan->days_left,
                    // отмека, что пользователь был исправлен
                    'updated' => !$this->isCheckValid,

                    // новые значения после обновления
                    'new_balance_usd' => $userPlan->balance_usd,
                    'new_balance_btc' => $userPlan->balance_btc,
                    'new_balance_eth' => $userPlan->balance_eth,
                    'new_balance_pzm' => $userPlan->balance_pzm,

                    'new_profit_usd' => $userPlan->profit_usd,
                    'new_profit_btc' => $userPlan->profit_btc,
                    'new_profit_eth' => $userPlan->profit_eth,
                    'new_profit_pzm' => $userPlan->profit_pzm,

                    'new_days_left' => $userPlan->days_left + $logItem->days_left,
                ]);

                // обновление пакета пользователя
                $userPlan->days_left += $logItem->days_left;
                if (!$this->isCheckValid) {
                    $userPlan->save();
                }
            }

            // создание оповещения и транзакции для каждой валюты по которой есть откат
            if (!$this->isCheckValid) {
                foreach ($rollbackAmount as $code => $amount) {
                    if ($amount > 0) {
                        // оповещение
                        $alert = new Alert();
                        $alert->user_id = $user->id;
                        $alert->alert_id = AlertType::SYSTEM;
                        $alert->amount = -$amount;
                        $alert->currency_type = $code;
                        $alert->save();

                        // транзакция для обновления баланса пользователя
                        $transaction = new Transaction();
                        $transaction->user_id = $user->id;
                        $transaction->transaction_type_id = TransactionsTypesConsts::SYSTEM;
                        $transaction->{'amount_' . $code} = -$amount;
                        $transaction->{'balance_' . $code . '_after_transaction'} = $user->{'balance_' . $code} - $amount;
                        $transaction->save();

                        // уменьшаем показатель прибыли, который был у пользователя
                        $user->{'profit_' . $code} -= $amount;
                        $user->save();
                    }
                }
            }

            DB::commit();
            if ($this->isCheckValid) {
                $this->info("[user_id: $userId] Пользователь будет успешно обновлен!");
            } else {
                $this->info("[user_id: $userId] Пользователь успешно обновлен!");
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error($e->getMessage());
            dump($e->getTraceAsString());
        }
    }

    /**
     * @return void
     */
    public function handle()
    {
        $choice = $this->choice('Меню', [
            'valid' => 'Проверить валидность',
            'table' => 'Наполнить таблицу',
            'start' =>  'Начать обновление',
            'match' =>  'Возврат матчинг бонусов',
            'money' =>  'Создание системной транзакции для изменения баланса',
            'plans' =>  'Выполнение начислений по конкретному пользователю и пакету',
        ], 'valid');

        if ($choice === 'valid') {
            $this->isCheckValid = true;
            $this->warn('Режим проверки совместимости');
        } elseif ($choice === 'table') {
            $this->warn('Режим наполнения таблицы');
            if ($this->logTable()->count()) {
                if (!$this->confirm('Таблица уже имеет записи, вы уверены, что хотите выполнить наполнение? Таблица будет очищена.')) {
                    $this->info('Отмена наполнения таблицы');
                    return;
                }
            }
        } elseif ($choice === 'start') {
            $this->error('Режим обновления пользователей');
            if ($this->confirm('Вы уверены, что хотите запустить обновление?', 'yes')) {
                $userId = $this->ask('Укажите ID пользователя (по умоланию будут исправлены все)', 'all');
                if ($userId === 'all') {
                    $this->info('Выборка всех неисправленных пользователей');
                    $userIds = $this->logTable()
                        ->select('user_id')
                        ->distinct()
                        ->where('updated', 0)
                        ->pluck('user_id')
                    ;
                    if ($this->confirm('Выбрано ' . count($userIds) . ' пользователей, выполнить обновление?')) {
                        if ($this->confirm('Выполнить проверку данных?')) {
                            $this->isCheckValid = true;
                        }
                        foreach ($userIds as $userId) {
                            $this->commandUpdateUser($userId);
                        }
                    } else {
                        $this->warn('Отмена обновления');
                        return;
                    }
                } else {
                    $this->commandUpdateUser($userId);
                }
            }
            return;
        } elseif ($choice === 'money') {
            $this->error('Режим создания системной транзакции');
            $this->commandCreateSystemTransaction();
            return;
        } elseif ($choice === 'plans') {
            $this->commandCreatePlanTransaction();
            return;
        } elseif ($choice === 'match') {
            $this->error('Режим возврата матчинг бонусов');
            if ($this->confirm('Вы уверены, что хотите запустить возврат матчинг бонусов?', 'yes')) {
                $userId = $this->ask('Укажите ID пользователя (по умоланию будут исправлены все)', 'all');
                if ($userId === 'all') {
                    $fromDatetime = $this->getDateTimeForRevert();
                    $toDatetime = $this->getDateTimeForRevertEnd();

                    /** @var $transactions Collection */
                    $userIds = Transaction::query()
                        ->select('user_id')
                        ->distinct()
                        ->where(['transaction_type_id' => 38])
                        ->whereRaw("created_at >= '$fromDatetime' AND created_at <= '$toDatetime'")
                        ->pluck('user_id');

                    if (!$this->confirm('Выбрано ' . count($userIds) . ' пользователей, выполнить обновление (матчинг бонусы)?')) {
                        $this->warn('Отмена возврата матчинг бонусов');
                        return;
                    }

                    foreach ($userIds as $userId) {
                        $this->commandUpdateMatchingUser($userId);
                    }
                } else {
                    $this->commandUpdateMatchingUser($userId);
                }
            } else {
                $this->warn('Отмена возврата матчинг бонусов');
            }
            return;
        }

        // пропускаем пользователей с пакетами бизнес и криптобизнес
        $excludedUserIds = UserMarketingPlan::query()
            ->select('user_id')
            ->whereNull('end_at')
            // 18, 19, 20, 21
            ->whereIn('marketing_plan_id', [19, 20, 21])
            ->distinct()
            ->pluck('user_id');

        $fromDatetime = $this->getDateTimeForRevert();
        $toDatetime = $this->getDateTimeForRevertEnd();

        // выбираем пользователей по опвещениям без пакетов криптобизнес и бизнес
        $users = Alert::query()
            ->select('user_id')
            ->whereRaw("created_at >= '$fromDatetime' AND created_at <= '$toDatetime'")
            //->whereNotIn('user_id', [2197,2154]) // TODO: remove
            //->whereNotIn('user_id', $excludedUserIds)
            ->distinct()
            ->pluck('user_id');

        foreach ($users as $userId) {
            $this->revertUser($userId);
        }

        $this->info('Обработано пользователей: ' . count($users));
    }

    /**
     * @return string
     */
    private function getDateTimeForRevert(): string
    {
        return '2020-11-28 23:52:00';
    }

    /**
     * @return string
     */
    private function getDateTimeForRevertEnd(): string
    {
        return '2020-11-28 23:59:59';
    }

    /**
     * @return int
     */
    private function getDaysCount(): int
    {
        return 8;
    }

    /**
     * @param int $userId
     */
    private function revertUser(int $userId)
    {
        $this->info('Пользователь: ' . $userId);

        $fromDatetime = $this->getDateTimeForRevert();
        $toDatetime = $this->getDateTimeForRevertEnd();

        /** @var $transactions Collection */
        $transactions = Transaction::query()
            ->where(['user_id' => $userId, 'transaction_type_id' => 2])
            ->whereRaw("created_at >= '$fromDatetime' AND created_at <= '$toDatetime'")
            ->orderByDesc('id')
            ->get()
        ;
        $this->info('Кол-во транзакций: ' . count($transactions));

        /** @var $alerts Collection */
        $alerts = Alert::query()
            ->where(['user_id' => $userId, 'alert_id' => 4])
            ->whereNotIn('marketing_plan_id', [18, 19, 20, 21])
            ->whereRaw("created_at >= '$fromDatetime' AND created_at <= '$toDatetime'")
            ->orderByDesc('id')
            ->get()
        ;

        /** @var Collection $alertsBp */
        $alertsBp = Alert::query()
            ->where(['user_id' => $userId, 'alert_id' => 4])
            ->whereIn('marketing_plan_id', [18])
            ->whereRaw("created_at >= '$fromDatetime' AND created_at <= '$toDatetime'")
            ->orderByDesc('id')
            ->get()
        ;

        /** @var Collection $alertsCryptoBpBtc */
        $alertsCryptoBpBtc = Alert::query()
            ->where(['user_id' => $userId, 'alert_id' => 4])
            ->whereIn('marketing_plan_id', [19])
            ->whereRaw("created_at >= '$fromDatetime' AND created_at <= '$toDatetime'")
            ->orderByDesc('id')
            ->get()
        ;

        /** @var Collection $alertsCryptoBpEth */
        $alertsCryptoBpEth = Alert::query()
            ->where(['user_id' => $userId, 'alert_id' => 4])
            ->whereIn('marketing_plan_id', [20])
            ->whereRaw("created_at >= '$fromDatetime' AND created_at <= '$toDatetime'")
            ->orderByDesc('id')
            ->get()
        ;

        /** @var Collection $alertsCryptoBpPzm */
        $alertsCryptoBpPzm = Alert::query()
            ->where(['user_id' => $userId, 'alert_id' => 4])
            ->whereIn('marketing_plan_id', [21])
            ->whereRaw("created_at >= '$fromDatetime' AND created_at <= '$toDatetime'")
            ->orderByDesc('id')
            ->get()
        ;

        $this->info('Кол-во оповещений: ' . count($alerts));

        $mix = [];
        $existsPlanIds = [];

        if ($alertsBp->count()) {
            $this->info('Обработка пакета Business');

            foreach ($alertsBp as $alertBp) {
                $balance_after_transaction = UserMarketingPlan::query()
                    ->where([
                        'user_id' => $alertBp->user_id,
                        'marketing_plan_id' => $alertBp->marketing_plan_id,
                    ])
                    ->whereNotIn('id', $existsPlanIds)
                    ->whereNull('end_at')
                    ->value('balance_' . $alertBp->currency_type);

                $insertItem = new Transaction([
                    'user_id' => $alertBp->user_id,
                    'amount_' . $alertBp->currency_type => $alertBp->amount,
                    'balance_' . $alertBp->currency_type . '_after_transaction' => $balance_after_transaction,
                ]);

                $this->info('Добавление оповещения и транзакции пакета Business');
                $alerts->push($alertBp);
                $transactions->push($insertItem);
            }

            $this->info('После коррекции');
            $this->info('Кол-во транзакций: ' . count($transactions));
            $this->info('Кол-во оповещений: ' . count($alerts));
        }

        if ($alertsCryptoBpBtc->count()) {
            $this->info('Обработка пакета CryptoBusiness BTC');

            foreach ($alertsCryptoBpBtc as $alertBp) {
                $activeUserPlanCount = UserMarketingPlan::query()
                    ->where([
                        'user_id' => $alertBp->user_id,
                        'marketing_plan_id' => $alertBp->marketing_plan_id,
                    ])
                    ->whereNull('end_at')
                    ->count();

                // обновление пользователей только с одним активным пакетом
                if ($activeUserPlanCount > 1) {
                    continue;
                }

                $balance_after_transaction = UserMarketingPlan::query()
                    ->where([
                        'user_id' => $alertBp->user_id,
                        'marketing_plan_id' => $alertBp->marketing_plan_id,
                    ])
                    ->whereNotIn('id', $existsPlanIds)
                    ->whereNull('end_at')
                    ->value('balance_' . $alertBp->currency_type);

                $insertItem = new Transaction([
                    'user_id' => $alertBp->user_id,
                    'amount_' . $alertBp->currency_type => $alertBp->amount,
                    'balance_' . $alertBp->currency_type . '_after_transaction' => $balance_after_transaction,
                ]);

                $this->info('Добавление оповещения и транзакции пакета CryptoBusiness BTC');
                $alerts->push($alertBp);
                $transactions->push($insertItem);
            }

            $this->info('После коррекции');
            $this->info('Кол-во транзакций: ' . count($transactions));
            $this->info('Кол-во оповещений: ' . count($alerts));
        }

        if ($alertsCryptoBpEth->count()) {
            $this->info('Обработка пакета CryptoBusiness ETH');

            foreach ($alertsCryptoBpEth as $alertBp) {
                $activeUserPlanCount = UserMarketingPlan::query()
                    ->where([
                        'user_id' => $alertBp->user_id,
                        'marketing_plan_id' => $alertBp->marketing_plan_id,
                    ])
                    ->whereNull('end_at')
                    ->count();

                // обновление пользователей только с одним активным пакетом
                if ($activeUserPlanCount > 1) {
                    continue;
                }

                $balance_after_transaction = UserMarketingPlan::query()
                    ->where([
                        'user_id' => $alertBp->user_id,
                        'marketing_plan_id' => $alertBp->marketing_plan_id,
                    ])
                    ->whereNotIn('id', $existsPlanIds)
                    ->whereNull('end_at')
                    ->value('balance_' . $alertBp->currency_type);

                $insertItem = new Transaction([
                    'user_id' => $alertBp->user_id,
                    'amount_' . $alertBp->currency_type => $alertBp->amount,
                    'balance_' . $alertBp->currency_type . '_after_transaction' => $balance_after_transaction,
                ]);

                $this->info('Добавление оповещения и транзакции пакета CryptoBusiness ETH');
                $alerts->push($alertBp);
                $transactions->push($insertItem);
            }

            $this->info('После коррекции');
            $this->info('Кол-во транзакций: ' . count($transactions));
            $this->info('Кол-во оповещений: ' . count($alerts));
        }

        if ($alertsCryptoBpPzm->count()) {
            $this->info('Обработка пакета CryptoBusiness ETH');

            foreach ($alertsCryptoBpPzm as $alertBp) {
                $activeUserPlanCount = UserMarketingPlan::query()
                    ->where([
                        'user_id' => $alertBp->user_id,
                        'marketing_plan_id' => $alertBp->marketing_plan_id,
                    ])
                    ->whereNull('end_at')
                    ->count();

                // обновление пользователей только с одним активным пакетом
                if ($activeUserPlanCount > 1) {
                    continue;
                }

                $balance_after_transaction = UserMarketingPlan::query()
                    ->where([
                        'user_id' => $alertBp->user_id,
                        'marketing_plan_id' => $alertBp->marketing_plan_id,
                    ])
                    ->whereNotIn('id', $existsPlanIds)
                    ->whereNull('end_at')
                    ->value('balance_' . $alertBp->currency_type);

                $insertItem = new Transaction([
                    'user_id' => $alertBp->user_id,
                    'amount_' . $alertBp->currency_type => $alertBp->amount,
                    'balance_' . $alertBp->currency_type . '_after_transaction' => $balance_after_transaction,
                ]);

                $this->info('Добавление оповещения и транзакции пакета CryptoBusiness PZM');
                $alerts->push($alertBp);
                $transactions->push($insertItem);
            }

            $this->info('После коррекции');
            $this->info('Кол-во транзакций: ' . count($transactions));
            $this->info('Кол-во оповещений: ' . count($alerts));
        }

        for ($i = 0; $i < count($alerts); $i++) {
            if (!isset($alerts[$i])) {
                dd($transactions[$i]);
            }

            if (!isset($transactions[$i])) {
                dd($alerts[$i]);
            }

            $mixItem = [
                'alert_id' => $alerts[$i]->id,
                'user_id' => $alerts[$i]->user_id,
                'marketing_plan_id' => $alerts[$i]->marketing_plan_id,
                'user_marketing_plan_id' => null,
                'code' => $alerts[$i]->currency_type,
                'amount_' . $alerts[$i]->currency_type => (double)$alerts[$i]->amount,
                'transaction_id' => $transactions[$i]->id ?? 1000000 + $i,
                't_amount_usd' => (double)$transactions[$i]->amount_usd,
                't_amount_btc' => (double)$transactions[$i]->amount_btc,
                't_amount_eth' => (double)$transactions[$i]->amount_eth,
                't_amount_pzm' => (double)$transactions[$i]->amount_pzm,
                't_balance_usd_after_transaction' => (double)$transactions[$i]->balance_usd_after_transaction,
                't_balance_btc_after_transaction' => (double)$transactions[$i]->balance_btc_after_transaction,
                't_balance_eth_after_transaction' => (double)$transactions[$i]->balance_eth_after_transaction,
                't_balance_pzm_after_transaction' => (double)$transactions[$i]->balance_pzm_after_transaction,
            ];

            // очистка пустых значений
            foreach ($mixItem as $key => $value) {
                if ($value === 0.0) {
                    unset($mixItem[$key]);
                }
            }

            $balance = $mixItem['t_balance_' . $mixItem['code'] . '_after_transaction'];
            $existsPlanIds = array_filter($existsPlanIds);
            $mixItem['user_marketing_plan_id'] = UserMarketingPlan::query()
                ->where([
                    'user_id' => $mixItem['user_id'],
                    'marketing_plan_id' => $mixItem['marketing_plan_id'],
                    'balance_' . $mixItem['code'] => $balance,
                ])
                ->whereNotIn('id', $existsPlanIds)
                ->whereNull('end_at')
                ->value('id');

            $existsPlanIds[] = $mixItem['user_marketing_plan_id'];

            $mix[] = $mixItem;
        }

        $this->info('Построение дерева');
        $userPlans = [];
        foreach ($mix as $item) {
            $userPlans[$item['user_id']][$item['marketing_plan_id']][] = $item;
        }

        // построение дерева и подстановка user_marketing_plan_id
        foreach ($userPlans as $userId => &$plans) {
            foreach ($plans as $planId => &$items) {
                $items = $this->findAndSet($items);
                $count = array_count_values(array_column($items, 'user_marketing_plan_id'));

                // replace
                $exists = [];

                foreach ($items as $k => $item) {
                    if (!isset($exists[$item['user_marketing_plan_id']])) {
                        $exists[$item['user_marketing_plan_id']] = [];
                    }

                    if (in_array($item["t_balance_{$item['code']}_after_transaction"], $exists[$item['user_marketing_plan_id']])) {
                        foreach ($items as $item2) {
                            if (
                                $count[$item2['user_marketing_plan_id']] < $this->getDaysCount() &&
                                $item['marketing_plan_id'] == $item2['marketing_plan_id'] &&
                                $item['user_marketing_plan_id'] != $item2['user_marketing_plan_id'] &&
                                $item["amount_{$item['code']}"] == $item2["amount_{$item2['code']}"] // точные расчеты
                            ) {
                                $this->info('REPLACE ' .  $item['user_marketing_plan_id'] . ' => ' . $item2['user_marketing_plan_id'] . ' ' . $item["t_balance_{$item['code']}_after_transaction"]);
                                $count[$items[$k]['user_marketing_plan_id']]--;
                                $count[$item2['user_marketing_plan_id']]++;
                                $items[$k]['user_marketing_plan_id'] = $item2['user_marketing_plan_id'];
                                $exists[$item['user_marketing_plan_id']][] = $item["t_balance_{$item['code']}_after_transaction"];
                                break;
                            }
                        }
                    } else {
                        $exists[$item['user_marketing_plan_id']][] = $item["t_balance_{$item['code']}_after_transaction"];
                    }
                }

                $preparedItems = [];
                foreach ($items as $item) {
                    if (!isset($preparedItems[$item['user_marketing_plan_id']]['code'])) {
                        $preparedItems[$item['user_marketing_plan_id']]['code'] = $item['code'];
                    }

                    if (!isset($preparedItems[$item['user_marketing_plan_id']]['amount'])) {
                        $preparedItems[$item['user_marketing_plan_id']]['amount'] = 0;
                    }

                    if (!isset($preparedItems[$item['user_marketing_plan_id']]['days_left'])) {
                        $preparedItems[$item['user_marketing_plan_id']]['days_left'] = 0;
                    }

                    // пакеты у которых одно оповещение, так как начисление раз в 7 дней,
                    // поэтому указываем в ручную нужное кол-во дней для отката
                    if (in_array($item['marketing_plan_id'], [18, 19, 20, 21])) {
                        $preparedItems[$item['user_marketing_plan_id']]['days_left'] = $this->getDaysCount();
                    } else {
                        $preparedItems[$item['user_marketing_plan_id']]['days_left']++;
                    }

                    $preparedItems[$item['user_marketing_plan_id']]['amount'] += (float)$item["amount_{$item['code']}"];
                    $preparedItems[$item['user_marketing_plan_id']]['items'][] = $item;
                }

                $items = $preparedItems;
            }
        }

        unset($items, $plans, $planId, $items);

        if ($this->isCheckValid) {
            $this->info('Проверка совместимости');
            $this->checkValid($mix);
            return;
        }

        // удаление предыдущих записей пользователя
        $this->logTable()->where('user_id', $userId)->delete();

        foreach ($userPlans as $userId => $plans) {
            foreach ($plans as $planId => $items) {
                foreach ($items as $userPlanId => $userPlanItem) {
                    $this->logTable()->insert([
                        'user_id' => $userId,
                        'marketing_plan_id' => $planId,
                        'user_marketing_plan_id' => $userPlanId,
                        'amount_' . $userPlanItem['code'] => $userPlanItem['amount'],
                        'days_left' => $userPlanItem['days_left'],
                    ]);
                }
            }
        }
    }

    /**
     * @param array $item
     * @return bool
     */
    private function isFixedPlan(array $item)
    {
        return !in_array($item['marketing_plan_id'], [18, 19, 20, 21, 22]);
    }

    /**
     * @param $items
     * @param null $parent
     * @return mixed
     */
    private function findAndSet(&$items, $parent = null)
    {
        foreach ($items as $index => &$item) {
            if ($parent && $item['user_marketing_plan_id']) {
                continue;
            }

            if ($parent && $this->getTargetAmount($item, $parent)) {
                $item['user_marketing_plan_id'] = $parent['user_marketing_plan_id'];
            }

            if ($item['user_marketing_plan_id']) {
                $items = $this->findAndSet($items, $item);
            } else {
                foreach ($items as $item2) {
                    if ($item2['user_marketing_plan_id'] && $this->getTargetAmount($item, $item2)) {
                        $item['user_marketing_plan_id'] = $item2['user_marketing_plan_id'];
                        $items = $this->findAndSet($items, $item);
                    }
                }
            }
        }

        return $items;
    }

    /**
     * @param array $item
     * @param array $parent
     * @return bool
     */
    private function getTargetAmount(array $item, array $parent)
    {
        // только для точных результатов
        if ($this->isFixedPlan($item) && $item["amount_{$item['code']}"] != $parent["amount_{$parent['code']}"]) {
            return false;
        }

        $left = round($item["t_balance_{$item['code']}_after_transaction"], 8);
        $right = round($parent["t_balance_{$parent['code']}_after_transaction"], 8) - round($parent["t_amount_{$parent['code']}"], 8);
        $right_2 = round($parent["t_balance_{$parent['code']}_after_transaction"], 8) - floor($parent["amount_{$parent['code']}"] * 100) / 100;
        $right_3 = round($parent["t_balance_{$parent['code']}_after_transaction"], 8) - round($parent["amount_{$parent['code']}"], 2);

        if (
            $this->isEqualFloat($left, $right) ||
            $this->isEqualFloat($left, $right_2) ||
            $this->isEqualFloat($left, $right_3)
        ) {
            // dump($left . ' == ' . $right . ' ~ ' . $parent["t_balance_{$parent['code']}_after_transaction"]);
            return true;
        }

//         $this->info($left . ' != ' . $right . ' ~ ' . $parent["t_balance_{$parent['code']}_after_transaction"]);

        return false;
    }

    /**
     * @param $left
     * @param $right
     * @return bool
     */
    private function isEqualFloat($left, $right): bool
    {
        return abs(($left - $right) / $right) < 0.00001;
    }

    /**
     * @param array $items
     */
    private function checkValid(array $items)
    {
        foreach ($items as $index => $item) {
            $code = 'amount_' . $item['code'];
            switch ($code) {
                case 'amount_usd':
                case 'amount_pzm':
                    $precision = 2;
                    $a_amount = round($item[$code], $precision);
                    $a_amount_2 = floor($item[$code] * 100) / 100;
                    break;
                default:
                    $precision = 8;
                    $a_amount = round($item[$code], $precision);
                    $a_amount_2 = $a_amount;
                    break;
            }

            $t_amount = round($item['t_' . $code], $precision);

            if ($a_amount === $t_amount || $a_amount_2 === $t_amount) {
                // $this->info('OK');
            } else {
                $this->info('ERROR ' . $item['marketing_plan_id'] . ' #' . $index);
                dd(
                    $item,
                    $a_amount,
                    $a_amount_2,
                    $t_amount
                );
                exit;
            }
        }
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    private function logTable()
    {
        return DB::table('revert_transaction');
    }

    /**
     * @return void
     */
    private function commandCreatePlanTransaction()
    {
        $this->error('Режим начислений по пользователю и пакету');

        $userId = $this->ask('Укажите ID/Email пользователя');

        if (!$userId) {
            $this->warn('Отмена операции');
            return;
        }

        $user = User::find($userId);
        if (!$user) {
            $user = User::where(['email' => $userId])->first();
            if (!$user) {
                $this->error('Пользователь не найден');
                return;
            }
        }

        $userMarketingPlans = UserMarketingPlan::whereUserId($user->id);

        if (!$userMarketingPlans->count()) {
            $this->warn('У пользователя нет активных пакетов.');
            return;
        }

        $userPlans = [];
        $menuPlans = [];
        foreach ($userMarketingPlans->get() as $userPlan) {
            $userPlans[$userPlan->id] = $userPlan;
            $menuPlans[$userPlan->id] = sprintf(
                '%s Осталось дней: %s Invested: %s%s Profit: %s%s Дата: %s',
                $userPlan->marketingPlan->name,
                $userPlan->days_left,
                $userPlan->{'invested_' . $userPlan->marketingPlan->currency_type},
                strtoupper($userPlan->marketingPlan->currency_type),
                $userPlan->{'profit_' . $userPlan->marketingPlan->currency_type},
                strtoupper($userPlan->marketingPlan->currency_type),
                $userPlan->created_at
            );
        }

        $userPlanId = $this->choice('Выберите пакет для выполнения ручных начислений', $menuPlans);
        $userPlanId = array_search($userPlanId, $menuPlans);

        $count = $this->ask('Укажите количество начислений', 1);

        if ($count > 5) {
            if (!$this->confirm("Вы уверены, что хотите начислить больше 5 раз?")) {
                $this->warn('Отмена операции.');
                return;
            }
        }

        $percents = $this->getAccruedPercents();

        for ($i = 0; $i < $count; $i++) {
            $this->accrueProfitToUserPlan($userPlans[$userPlanId], $percents);
            sleep(1);
        }

        $this->info('Прибыль успешно начислена');
    }

    /**
     * @param UserMarketingPlan $userMarketingPlan
     * @param array $percents
     */
    private function accrueProfitToUserPlan(UserMarketingPlan $userMarketingPlan, array $percents)
    {
        $marketingPlan = $userMarketingPlan->marketingPlan;
        $user = User::find($userMarketingPlan->user_id);

        $code = $marketingPlan->currency_type;

        $codeAmount = 'amount_'.$code;
        $codeProfit = 'profit_'.$code;
        $codeBalans = 'balance_'.$code;
        $codeInvested = 'invested_'.$code;
        $code_balance_after_transaction = 'balance_'.$code.'_after_transaction';

        // - определение процента, который будет начисляться
        // - обработка способа начисления
        if (
            $marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_BUSINESS) ||
            $marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_CRYPTO_BUSINESS)
        ) {
            $daysDiff = 200 - $userMarketingPlan->days_left;
            if ($userMarketingPlan->days_left === 200 || $daysDiff % 7 !== 0) {
                $userMarketingPlan->days_left = $userMarketingPlan->days_left - 1;
                $userMarketingPlan->save();
                return;
            }
            $percent = $percents[$marketingPlan->id];
            // сложный процент
            $amountUsd = $userMarketingPlan->$codeInvested + $userMarketingPlan->$codeProfit;
        } elseif ($marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_MINI)) {
            $percent = $percents[$marketingPlan->id];
            $amountUsd = $userMarketingPlan->$codeInvested;
        } else {
            $percent = $marketingPlan->daily_percent;
            $amountUsd = $userMarketingPlan->$codeInvested;
        }

        $coinPercent = $marketingPlan->coin_percent;
        $profitUsd = $amountUsd / 100 * $percent;
        $profiTtoCoinBalance = $profitUsd / 100 * $coinPercent;
        $profitUsdClear = $profitUsd - $profiTtoCoinBalance;
        //$bodyUsd = $amountUsd / $marketingPlan->min_duration;

        // По модулю берем, поскольку может быть и "-"
        if (abs($profitUsdClear) < 0.01 && $code == 'usd') {
            $this->info("Не начисляем - маленькая сумма ($$profitUsdClear)");
            return;
        }

        if (!$this->confirm(sprintf(
            'Пользователю будет начислена прибыль %s%s, продолжить?',
            $profitUsdClear,
            strtoupper($code)
        ))) {
            return;
        }

        // Создаем транзакцию - прибыль от инвест. в маркетинговый план
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->transaction_type_id = TransactionsTypesConsts::PROFIT_TYPE_ID;
        $transaction->$codeAmount = $profitUsdClear;
        if ($code != 'usd') {
            $transaction->amount_crypto = $profitUsdClear*$userMarketingPlan->rate;
        }
        $user->$codeProfit += $profitUsd;
        $user->save();

        $transaction->$code_balance_after_transaction = $userMarketingPlan->$codeBalans + $profitUsdClear;
        if (
            $marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_BUSINESS) ||
            $marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_CRYPTO_BUSINESS)
        ) {
            // пользователь выводит самостоятельно прибыль
        } else {
            $transaction->save();
        }

        // Изменяем балансы текущего маркетинг-плана
        $userMarketingPlan->coin_usd += $profiTtoCoinBalance;
        $userMarketingPlan->$codeBalans += $profitUsdClear;
        $userMarketingPlan->$codeProfit += $profitUsd;
        $userMarketingPlan->days_left = $userMarketingPlan->days_left - 1;
        $userMarketingPlan->save();

        $alert                    = new Alert();
        $alert->user_id           = $user->id;
        $alert->alert_id          = AlertType::ACCRUAL_OF_DAILY_INVESTMENT;
        $alert->amount            = $profitUsdClear;
        $alert->currency_id       = $transaction->currency_id;
        $alert->marketing_plan_id = $userMarketingPlan->marketing_plan_id;
        $alert->currency_type     = $code;
        $alert->save();

        $this->info(sprintf(
            'Прибыль %s%s успешно начислена, осталось дней: %s.',
            $profitUsdClear,
            strtoupper($code),
            $userMarketingPlan->days_left
        ));
    }

    /**
     * @return array
     */
    public function getAccruedPercents()
    {
        $res = [];
        foreach (MarketingPlan::all() as $plan) {
            if ($plan->manual_percent && strstr($plan->manual_percent, ':')) {
                $percent = explode(':', $plan->manual_percent);
                $plan->min_profit = (float)$percent[0];
                $plan->max_profit = (float)$percent[1];
                $plan->manual_percent = null;
            }
            $res[$plan->id] = $plan->manual_percent ?? $this->getRandomBetween($plan->min_profit, $plan->max_profit);
        }

        $this->info("Используем проценты для начислений: " . print_r($res, true));

        return $res;
    }

    /**
     * Возвращает случайный процент из заданного диапазона.
     *
     * @param float $min
     * @param float $max
     * @return float
     */
    public function getRandomBetween(float $min, float $max): float
    {
        return mt_rand($min * 100, $max * 100) / 100;
    }
}
