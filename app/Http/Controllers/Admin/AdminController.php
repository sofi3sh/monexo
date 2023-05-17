<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Accrual;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Consts\WalletsTypesConsts;
use App\Models\Home\Currency;
use App\Models\Home\Rate;
use App\Models\Home\Transaction;
use App\Models\Home\UserMarketingPlan;
use App\Models\Home\Wallet;
use App\Models\User;
use App\Repositories\Invite\InviteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Home\TransactionType;
use App\Models\Home\News;
use App\Http\Requests\Admin\StoreTransferBetweenAccount;
use App\Models\Admin\Config;
use App\Models\Home\MarketingPlan;
use App\Models\Home\UserPaymentDetail;
use App\Models\Home\Alert;
use App\Models\Consts\AlertType;
use App\Notifications\Withdrawal;
use App\Notifications\Deposit;
use App\Models\WithdrawVerification;
use App\Models\UserStatusRequest;
use App\Models\UserStatus;
use App\Services\Packages\UserPackagesInfoService;
use Illuminate\View\View;
use App\Services\WhitebitService;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        WhitebitService $whitebitService
    )
    {
        $this->middleware('auth');
    }

    public function showMainPage()
    {
        //todo сделать через scope
         $invested = Transaction::whereIn('transaction_type_id', [TransactionsTypesConsts::INVEST_TYPE_ID])
            ->where('created_at', '>=', now()->subDays(2)->format('Y-m-d h:m:i'))->whereNull('editor_id')
            ->whereHas(
                'user', function ($query) {
                $query->where('fake', 0);
            }
            )
            ->get();
        $invested->load('user');

         $bonuses = Transaction::whereIn('transaction_type_id', [TransactionsTypesConsts::BONUSES_TYPE_ID])
            ->where('created_at', '>=', now()->subDays(2)->format('Y-m-d h:m:i'))
            ->whereHas(
                'user', function ($query) {
                $query->where('fake', 0);
            }
            )
            ->whereHas(
                'editorUser', function ($query) {
                $query->where('fake', 0);
            }
            )
            ->get();
        $bonuses->load('user', 'editorUser');

        $withdrawals = Transaction::where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_TYPE_ID)
            ->where('created_at', '>', now()->subDays(2))
            ->whereHas(
                'user', function ($query) {
                $query->where('fake', 0);
            }
            )
            ->get();
        $withdrawals->load('user');

        $withdrawal_requests = Transaction::where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID)
            ->where('created_at', '>=', now()->subDays(2))
            ->whereHas(
                'user', function ($query) {
                $query->where('fake', 0);
            }
            )
            ->get();
        $withdrawal_requests->load('user');

        $accruals = Accrual::where('created_at', '>=', now()->subDays(2))->get();

        $now = (Carbon::now());
        $rates_last_update = Carbon::parse(Rate::min('updated_at'));
        $diff_in_minutes = $now->diffInMinutes($rates_last_update);

        // Выполненные переводы между аккаунтами
        $transfers = $withdrawal_requests = Transaction::where('transaction_type_id', TransactionsTypesConsts::TRANSFER_BETWEEN_ACCOUNTS_TYPE_ID)
            ->where('created_at', '>=', now()->subDays(3))
            ->where('amount_usd', '<', 0)
            ->whereHas(
                'user', function ($query) {
                $query->where('fake', 0);
            }
            )
            ->get();
        $withdrawal_requests->load('user');

        $replenish_from_admin = Transaction::whereIn('transaction_type_id', [TransactionsTypesConsts::ACCRUED_THROUGH_ADMIN])
            ->where('created_at', '>=', now()->subDays(2)->format('Y-m-d h:m:i'))->whereNotNull('editor_id')
            ->whereHas(
                'user', function ($query) {
                $query->where('fake', 0);
            }
            )
            ->whereHas(
                'editorUser', function ($query) {
                $query->where('fake', 0);
            }
            )
            ->get();
        $replenish_from_admin->load('user', 'editorUser', 'currency');
        return view('admin.main')
            ->with(['invested'              => $invested,
                    'bonuses'               => $bonuses,
                    'withdrawal_requests'   => $withdrawal_requests,
                    'withdrawals'           => $withdrawals,
                    'accruals'              => $accruals,
                    'diff_in_minutes'       => $diff_in_minutes,
                    'rates_last_update'     => $rates_last_update,
                    'transfers'             => $transfers,
                    'replenish_from_admin'  => $replenish_from_admin,
            ]);
    }

    public function showClientsPage()
    {
        $clients = User::all();
//        $clients->load('ancestor');
        return view('admin.clients')->with('clients', $clients);
    }

    public function replenishBalance(Request $request, $user_id){
        $user = User::where('id', $user_id)->first();
        DB::beginTransaction();
        try{
            $transaction                                = new Transaction;
            $transaction->user_id                       = $user_id;
            $transaction->transaction_type_id           = TransactionsTypesConsts::ACCRUED_THROUGH_ADMIN;
            $transaction->amount_usd                    = $request->amount;
            $transaction->editor_id                     = Auth()->user()->id;
            $transaction->currency_id                   = $request->currency_id;
            $transaction->balance_usd_after_transaction = $user->balance_usd+$request->amount;
            $transaction->save();

            $user->replenishment += $request->amount;
            $user->balance_usd   += $request->amount;
            $user->save();

            $payout                  = new UserPaymentDetail();
            $payout->currency_id     = $request->currency_id;
            $payout->user_id         = $user_id;
            $payout->address         = 'tt-admin';
            $payout->transaction_id  = $transaction->id;
            $payout->additional_data = "Balance replenishment#".$request->amount.'#USD';
            $payout->save();

            $alert              = new Alert;
            $alert->user_id     = $user_id;
            $alert->alert_id    = AlertType::REPLANISHMENT_ACCOUNT;
            $alert->amount      = $request->amount;
            $alert->currency_id = $request->currency_id;
            $alert->save();

            $alertParent              = new Alert;
            $alertParent->user_id     = $user->parent_id;
            $alertParent->alert_id    = AlertType::PARTNER_REPLENISHMENT;
            $alertParent->email       = $user->email;
            $alertParent->amount      = $request->amount;
            $alertParent->currency_id = $request->currency_id;
            $alertParent->save();

            DB::commit();


            return response()->json(['message'=>'Ваше начисление одобрено.', 'error' => false]);
        }catch(\Exception $e) {
            DB::rollback();
            return back()->with(['flash_danger' => 'Ошибка '. $e->getMessage()]);
        }
    }

    public function replenishBonuses(Request $request, $user_id) {
        $user = User::where('id', $user_id)->first();
        DB::beginTransaction();
        try{
            $transaction                                = new Transaction;
            $transaction->user_id                       = $user_id;
            $transaction->transaction_type_id           = TransactionsTypesConsts::BONUSES_TYPE_ID;
            $transaction->amount_usd                    = $request->bonus;
            $transaction->editor_id                     = Auth()->user()->id;
            $transaction->currency_id                   = 24;
            $transaction->balance_usd_after_transaction = $user->balance_usd+$request->bonus;
            $transaction->save();

            $user->balance_usd += $request->bonus;
            $user->save();

            $payout                  = new UserPaymentDetail();
            $payout->currency_id     = 24;
            $payout->user_id         = $user_id;
            $payout->address         = 'tt-admin';
            $payout->transaction_id  = $transaction->id;
            $payout->additional_data = "Bonus replenishment#".$request->bonus.'#USD';
            $payout->save();

            $alert              = new Alert;
            $alert->user_id     = $user_id;
            $alert->alert_id    = AlertType::ACCRUAL_OF_BONUSES;
            $alert->amount      = $request->bonus;
            $alert->currency_id = 24;
            $alert->save();

            DB::commit();


            return response()->json(['message'=>'Ваше начисление одобрено.', 'error' => false]);
        }catch(\Exception $e) {
            DB::rollback();
            return back()->with(['flash_danger' => 'Ошибка '. $e->getMessage()]);
        }
    }

    public function showWithdrawalRequestsPage()
    {
        $withdrawal_requests = Transaction::where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID)
            ->orderBy('id', 'desc')
            ->get();

        $withdrawal_requests->load('user', 'wallet', 'wallet.currency', 'currency');
        return view('admin.withdrawal-requests')->with('withdrawal_requests', $withdrawal_requests);
    }

    /**
     * Отображение страницы пользователя
     *
     * @param User $id
     * @return mixed
     */
    public function showClientPage(User $id)
    {
        // Заявки на вывод
        $withdrawal_requests = Transaction::where('user_id', $id->id)
            ->where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID)
            ->orderBy('id', 'desc')
            ->get();
        $withdrawal_requests->load('user', 'wallet', 'wallet.currency');

        // Транзакции
        $transactions = Transaction::where('user_id', $id->id)
            ->orderBy('id', 'desc')
            ->get();
        $transactions->load('wallet', 'wallet.currency', 'transactionType');

        // Инвестиции
        $invests = Transaction::where('user_id', $id->id)
            ->where('transaction_type_id', TransactionsTypesConsts::INVEST_TYPE_ID)
            ->orderBy('id', 'desc')
            ->get();
        $invests->load('wallet', 'wallet.currency');

        // Платежные системы (теперь в одной таблице и крипта и платежные системы)
        $currencies = Currency::all();
        $transaction_types = TransactionType::all();

        // Сгенерированные кошельки
        $crypto_wallets = Wallet::where('user_id', $id->id)
            ->where('wallet_type_id', WalletsTypesConsts::INVEST_WALLET_TYPE_ID)
            ->get();
        $crypto_wallets->load('currency');


        return view('admin.client')
            ->with('withdrawal_requests', $withdrawal_requests)
            ->with('transactions', $transactions)
            ->with('invests', $invests)
            ->with('user', $id)
            ->with('transaction_types', $transaction_types)
            ->with('currencies', $currencies)
            ->with('crypto_wallets', $crypto_wallets)
            ->with('id', $id->id);
    }

    /*
    * Авторизоваться как клиент
    *
    * @param User $user
    * @return \Illuminate\Http\RedirectResponse
    */
    public function loginAsClient(User $user)
    {
        \Auth::logout();

        \Auth::loginUsingId($user->id);

        return redirect()->route('home.main');
    }

    /**
     * Заблокировать/разблокировать клиента.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function blockedClient(User $user)
    {
        $currentUserId = Auth::user()->id;
        if ($user && $user->id && $currentUserId !== $user->id) {
            User::on()
                ->where('id', $user->id)
                ->update( [ 'is_active' => ($user->is_active ? 0 : 1) ] );
        }

        /*
        if ($user && $user->id) {
            Transaction::where('related_user_id', $user->id)->forceDelete();
            DB::transaction(function () use ($user) {
                WithdrawVerification::where('user_id', $user->id)->delete();

                $user->forceDelete();
            });
        }
        */
        return redirect()->route('admin.clients');
    }

    public function withdrawalRequestsAll()
    {
        $allTransaction = Transaction::on()->
        where('transaction_type_id', TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID)
            ->whereIn('currency_id', Currency::where('code', 'USD')
                ->pluck('id')->toArray()
            )
            ->where('amount_usd', '>', -500)
            ->get();

        foreach ($allTransaction as $transaction) {
            $this->confirmWithdrawal($transaction);
        }

        return back();
    }

    public function confirmWithdrawal(Transaction $id)
    {
        try {
            DB::beginTransaction();

            // Изменяем тип транзакции с "Заявки на вывод" на "Вывод".
            $id->transaction_type_id = TransactionsTypesConsts::WITHDRAWAL_TYPE_ID;
            $id->editor_id = Auth::user()->id;
            $id->save();


            Log::channel('actionlog')->info(Auth()->user()->email . '(id=' . Auth()->user()->id . ') подтвердил вывод средств id=' . $id->id . ' ' . serialize($id));

            // Если инвестированная после вывода сумма меньше, чем необходимая для текущего плана — план автоматически понижается.
            // т.е. если баланс пользователя меньше стоимости текущего плана - понижаем план
            $code       = strtolower($id->currency->code) == 'usdt' ? 'usd' : $id->currency->code;
            $codeAmount = 'amount_'.strtolower($code);

            $user = User::find($id->user_id);

            $data = [
                'amount' => $id->$codeAmount,
                'code'   => $code,
            ];

            $cryptoWallet = Wallet::where('user_id', $id->user_id)
                ->where('wallet_type_id', WalletsTypesConsts::INVEST_WALLET_TYPE_ID)
                ->where('currency_id', $id->currency->id)
                ->first();
            $response = $this->whitebitService->withdraw($id->$codeAmount, $cryptoWallet['address'], 'USDT');

            $user->notify(new Withdrawal($data));

            UserPaymentDetail::where('transaction_id', $id->id)->update(['address'=>'Confirmed']);


            DB::commit();
            $msg_type = 'flash_success';
            $msg = 'Вывод средств проведен.';
        } catch (\Exception $e) {
            DB::rollback();
            $msg_type = 'flash_danger';
            $msg = $e->getMessage();
            Log::error($e->getMessage());
        }

        return back()->with($msg_type, $msg);
    }

    public function deleteConfirmWithdrawal(Transaction $id)
    {
        try {
            DB::beginTransaction();
            $id->delete();
            $id->editor_id = Auth::user()->id;
            UserPaymentDetail::where('transaction_id', $id->id)->update(['address'=>'Canceled']);
            DB::commit();
            $msg_type = 'flash_success';
            $msg = 'Заявка на вывод удалена.';
        } catch (\Exception $e) {
            DB::rollback();
            $msg_type = 'flash_danger';
            $msg = $e->getMessage();
            Log::error($e->getMessage());
        }

        return back()->with($msg_type, $msg);
    }

    /**
     * Отображение страницы начислений
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAccrualsPage()
    {
        $accruals = Accrual::orderBy('id', 'desc')
            ->get();
        return view('admin.accruals')->with('accruals', $accruals);
    }

    /**
     * Отображение страницы Системные
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSystemPage()
    {
        $activePackages = UserMarketingPlan::query()
            ->selectRaw('marketing_plan_id, COUNT(marketing_plan_id) AS cnt')
            ->whereRaw('end_at IS NULL')
            ->groupBy('marketing_plan_id')
            ->get()
            ->pluck('cnt', 'marketing_plan_id');

        $marketingPlans = MarketingPlan::all();

        return view('admin.system')
            ->with([
                'marketingPlans' => $marketingPlans,
                'activePackages' => $activePackages,
            ]);
    }


    /**
     * Статистика по клиентам
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showStatsPage(Request $request)
    {
        $dateFrom = request('filter.from');
        $dateTo = request('filter.to');

        $sqlGlobal = "
            SELECT
                -- клиенты без депозитов
                (
                    SELECT COUNT(id)
                    FROM users
                    WHERE id NOT IN (SELECT DISTINCT user_id FROM user_marketing_plans WHERE end_at IS NOT NULL)
                ) AS `count_users_without_plans`,
                -- клиенты без реф ссылок и без депозитов
                (
                    SELECT COUNT(id)
                    FROM users
                    WHERE parent_id <> 1 AND id NOT IN (SELECT DISTINCT user_id FROM user_marketing_plans WHERE end_at IS NULL)
                ) AS `count_users_without_plans_and_without_ref`,
                -- клиенты с реф ссылкой и без депозитов
                (
                    SELECT COUNT(id)
                    FROM users
                    WHERE parent_id = 1 AND id NOT IN (SELECT DISTINCT user_id FROM user_marketing_plans WHERE end_at IS NULL)
                ) AS `count_users_with_plans_and_without_ref`,
                -- количество активных пакетов сейчас в системе
                (
                    SELECT COUNT(id) FROM user_marketing_plans WHERE end_at IS NULL
                ) AS `count_plans_active`
        ";

        $sql = "
SELECT
	-- выведено денег (сумма в $)
	(
	    SELECT SUM(ABS(amount_usd))
	    FROM transactions
	    WHERE deleted_at IS NULL AND transaction_type_id = 14 AND created_at BETWEEN '{$dateFrom} 00:00:00' AND '{$dateTo} 23:59:59'
    ) AS `sum_withdraw`,
	-- купили пакетов (кол-во)
	(
        SELECT COUNT(id) FROM user_marketing_plans WHERE end_at IS NULL AND created_at BETWEEN '{$dateFrom} 00:00:00' AND '{$dateTo} 23:59:59'
    ) AS `count_plans_new`,
    -- купили пакетов (сумма $)
	(
        SELECT SUM(ABS(amount_usd)) FROM transactions WHERE deleted_at IS NULL AND transaction_type_id = 29 AND created_at BETWEEN '{$dateFrom} 00:00:00' AND '{$dateTo} 23:59:59'
    ) AS `sum_plans_new`,
	-- регистраций по датам (календарик)
	(
	    SELECT COUNT(id) FROM users WHERE email_verified_at BETWEEN '{$dateFrom} 00:00:00' AND '{$dateTo} 23:59:59'
    ) AS `count_users_new`,
	-- регистраций по датам (календарик)
	(
	    SELECT COUNT(id) FROM users WHERE created_at BETWEEN '{$dateFrom} 00:00:00' AND '{$dateTo} 23:59:59'
    ) AS `count_users_new_all`
        ";

        // какой пакет покупали больше всего
        $sqlTopPlans = "
            SELECT marketing_plans.name, COUNT(user_marketing_plans.id) AS `cnt`
			FROM user_marketing_plans
            JOIN marketing_plans ON marketing_plans.id = user_marketing_plans.marketing_plan_id
			WHERE user_marketing_plans.created_at BETWEEN '{$dateFrom} 00:00:00' AND '{$dateTo} 23:59:59'
			GROUP BY user_marketing_plans.marketing_plan_id
			ORDER BY `cnt` DESC
			LIMIT 3 -- количество
        ";

        // клиенты которые выводят больше всех
        $sqlTopUsersWithdraw = "
            SELECT
                users.email,
				SUM(ABS(transactions.amount_usd)) AS `sum`
			FROM
				transactions
            JOIN users ON users.id = transactions.user_id
			WHERE
                transactions.deleted_at IS NULL AND
				transactions.transaction_type_id = 14 AND
				transactions.created_at BETWEEN '{$dateFrom} 00:00:00' AND '{$dateTo} 23:59:59'
			GROUP BY users.email
			ORDER BY `sum` DESC
			LIMIT 20
        ";

        // клиенты которые выводят больше всех
        $sqlTopUsersInvest = "
            SELECT
                users.email,
				SUM(ABS(transactions.amount_usd)) AS `sum`
			FROM
				transactions
            JOIN users ON users.id = transactions.user_id
			WHERE
                transactions.deleted_at IS NULL AND
				transactions.transaction_type_id = 29 AND
				transactions.created_at BETWEEN '{$dateFrom} 00:00:00' AND '{$dateTo} 23:59:59'
			GROUP BY users.email
			ORDER BY `sum` DESC
			LIMIT 20
        ";

        $statsGlobal = DB::select(DB::raw($sqlGlobal));
        if (isset($statsGlobal[0])) {
            $statsGlobal = (array)$statsGlobal[0];
        }

        $stats = null;
        if ($dateFrom) {
            $stats = DB::select(DB::raw($sql));

            if (isset($stats[0])) {
                $stats = $stats[0];
                $stats = (array)$stats;
            }

            $stats['top_marketing_plan'] = DB::select(DB::raw($sqlTopPlans));
            $stats['count_users_withdraw_max'] = DB::select(DB::raw($sqlTopUsersWithdraw));
            $stats['count_users_invest_max'] = DB::select(DB::raw($sqlTopUsersInvest));
        }

        if ( ! is_null( $dateFrom ) && ! is_null( $dateTo ) ) {
            $inviteRepository = new InviteRepository( $dateFrom, $dateTo );
            $invite                             = $inviteRepository->getStatisticsInvitePeriod();
            $topSenderInvite                    = $inviteRepository->getTopSenderInvite();
            $countPackageInvite                 = $inviteRepository->getCountPackageInvite();
            $sumPackageInvite                   = $inviteRepository->getSumPackageInvite();
            $sumInternalTransfer                = $inviteRepository->getSumInternalTransfer();
            $countOpenPackage                   = $inviteRepository->getCountOpenPackage();
            $countClosePackage                  = $inviteRepository->getCountClosePackage();
            $listPackages                       = $inviteRepository->getListPackages();
            $replenishmentAmount                = $inviteRepository->getReplenishmentAmount();
            $bonusLineProgram                   = $inviteRepository->getBonusLineProgram();
            $bonusCareerProgram                 = $inviteRepository->getBonusCareerProgram();
            $matchingBonus                      = $inviteRepository->getMatchingBonus();
            $sumInternalTransferTop             = $inviteRepository->getSumInternalTransferTop();
            $cities                             = $inviteRepository->getCities();

            $totalCommissionInvite              = $inviteRepository->getTotalCommissionInvite();
            $topUserCommissionInvite            = $inviteRepository->getTopUserCommissionInvite();

            $totalCommissionConclusions         = $inviteRepository->getTotalCommissionConclusions();
            $topCommissionConclusions           = $inviteRepository->getTopCommissionConclusions();

            $totalCommissionInternalTransfer    = $inviteRepository->getTotalCommissionInternalTransfer();
            $topCommissionInternalTransfer      = $inviteRepository->getTopCommissionInternalTransfer();

            $debtDeposit                        = $inviteRepository->getDebtDeposit();
            $debtDepositFloating                        = $inviteRepository->getDebtDepositFloating();
        }

        return view('admin.stats')->with([
            'stats'                             => $stats,
            'statsGlobal'                       => $statsGlobal,
            'invite'                            => $invite ?? null,
            'topSenderInvite'                   => $topSenderInvite ?? null,
            'countPackageInvite'                => $countPackageInvite ?? null,
            'sumPackageInvite'                  => $sumPackageInvite ?? null,
            'sumInternalTransfer'               => $sumInternalTransfer ?? null,
            'countOpenPackage'                  => $countOpenPackage ?? null,
            'countClosePackage'                 => $countClosePackage ?? null,
            'listPackages'                      => $listPackages ?? null,
            'replenishmentAmount'               => $replenishmentAmount ?? null,
            'bonusLineProgram'                  => $bonusLineProgram ?? null,
            'bonusCareerProgram'                => $bonusCareerProgram ?? null,
            'matchingBonus'                     => $matchingBonus ?? null,
            'sumInternalTransferTop'            => $sumInternalTransferTop ?? null,
            'cities'                            => $cities ?? null,
            'totalCommissionInvite'             => $totalCommissionInvite ?? null,
            'topUserCommissionInvite'           => $topUserCommissionInvite ?? null,
            'totalCommissionConclusions'        => $totalCommissionConclusions ?? null,
            'topCommissionConclusions'          => $topCommissionConclusions ?? null,
            'totalCommissionInternalTransfer'   => $totalCommissionInternalTransfer ?? null,
            'topCommissionInternalTransfer'     => $topCommissionInternalTransfer ?? null,
            'debtDeposit'                       => $debtDeposit ?? null,
            'debtDepositFloating'               => $debtDepositFloating ?? null,
        ]);
    }

    /**
     * Сделать email пользователя верифицированным
     *
     * @param User $user
     */
    public function emailVerified(User $user)
    {
        $user->email_verified_at = Carbon::now();
        $user->save();
        return back();
    }

    /**
     * Отключить 2FA у пользователя.
     *
     * @param User $user
     */
    public function disable2Fa(User $user)
    {
        /*$user->email_verified_at = Carbon::now();
        $user->save();
        удалить запись с
        password_securities*/

        return back();
    }

    /**
     * Изменение на противоположное фейковости пользователя.
     *
     * @param User $user
     */
    public function changeFake(User $user)
    {
        $user->fake = !$user->fake;
        $user->save();

        return back();
    }

    /**
     * Создать транзакцию (вручную).
     *
     * @param User $user
     */
    public function createTransaction(Request $request)
    {
        try {
            DB::beginTransaction();
            // Форматируем дату
            $t = str_replace('T', ' ', $request->created_at);
            $t = date_create_from_format('Y-m-d H:i', $t);
            $t = $t->format('Y-m-d H:i') . ':' . rand(10, 59);
            $request->merge(['created_at' => $t]);

            // Если не ввели сумму в крипте и указали курс - рассчтиываем сумму в крипте
            if (is_null($request->amount_crypto) && !is_null($request->rate)) {
                $request->merge(['amount_crypto' => $request->amount_usd / $request->rate]);
            } elseif (is_null($request->amount_usd)) { //Если не ввели сумму в USD - рассчитываем ее
                $request->merge(['amount_usd' => $request->amount_crypto * $request->rate]);
            }

            // Для вывода и запроса на вывод ставим с суммы с "-" и соотв. тип кошелька
            if (in_array($request->transaction_type_id,
                [
                    TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID,
                    TransactionsTypesConsts::WITHDRAWAL_TYPE_ID
                ])) {
                $request->merge(['amount_usd' => -$request->amount_usd]);
                $request->merge(['commission' => is_null(Auth::user()->motivation_plan_id) ? config('finance.commission_profit_withdrawal') : config('finance.commission_profit_withdrawal')]);
                $request->merge(['amount_crypto' => -$request->amount_crypto]);
                $wallet_type_id = WalletsTypesConsts::WITHDRAWAL_WALLET_TYPE_ID;
            } else {
                $request->merge(['amount_usd' => $request->amount_usd]);
                $request->merge(['amount_crypto' => $request->amount_crypto]);
                // Устанавливаем тип кошелька - введенный вручную
                $wallet_type_id = WalletsTypesConsts::MANUAL_INVEST_WALLET_TYPE_ID;
            }

            // Создаем фейковый кошелек для всех типов транзакций, кроме прибыли, реферальных и бонусов
            if (!in_array($request->transaction_type_id,
                [
                    TransactionsTypesConsts::PROFIT_TYPE_ID,
                    TransactionsTypesConsts::ALL_REFERRAL_PROFIT_TYPES,
                    TransactionsTypesConsts::BONUSES_TYPE_ID
                ])) {
                $wallet = Wallet::firstOrCreate([
                    'user_id'         => $request->user_id,
                    'currency_id'     => $request->currency_id,
                    'address'         => $request->address,
                    'additional_data' => $request->additional_data,
                    'wallet_type_id'  => $wallet_type_id,
                ]);
                $request->merge(['wallet_id' => $wallet->id]);
            }

            $end_period = null;
            // todo По-хорошему, end_period надо выставлять в TransactionObserver
            // todo Для транзакции инвестирования определяем end_period
            if ($request->transaction_type_id == TransactionsTypesConsts::INVEST_TYPE_ID) {
                $t2 = Carbon::createFromFormat('Y-m-d H:i:s', $t, config('app.timezone'));
                $end_period = $t2->addDays(config('finance.contract_duration_with_traders'));
            }
            //
            $user = User::find($request->user_id);
            $request->merge([
                'balance_usd_after_transaction' => $user->balance_usd + $request->amount_usd,
                'user_id'                       => $request->user_id,
                'end_period'                    => $end_period,
                'manual'                        => true,
            ]);

            $transaction = Transaction::create($request->all());
            Log::channel('actionlog')->info('Админка. ' . Auth()->user()->email . '(id=' . Auth()->user()->id . ') создал транзакцию: ' . $transaction->toJson());
            DB::commit();
            $msg_type = 'flash_success';
            $msg = 'Транзакция создана.';
        } catch (\Exception $e) {
            DB::rollback();
            $msg_type = 'flash_danger';
            $msg = $e->getMessage();
            Log::error($e->getMessage());
        }

        return back()->with($msg_type, $msg);
    }

    /**
     * Удалить транзакцию (вручную).
     *
     * @param User $user
     */
    public function deleteTransaction(Transaction $Transaction)
    {
        try {
            DB::beginTransaction();
            $Transaction->delete();
            $Transaction->editor_id = Auth::user()->id;
            DB::commit();
            $msg_type = 'flash_success';
            $msg = 'Транзакция удалена.';
        } catch (\Exception $e) {
            DB::rollback();
            $msg_type = 'flash_danger';
            $msg = $e->getMessage();
            Log::error($e->getMessage());
        }

        return back()->with($msg_type, $msg);
    }

    /**
     * Сменить предка пользователя.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeAncestor(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = User::find($request->user_id);
            $new_ancestor = User::where('email', $request->move_under)->first();
            $user->parent_id = $new_ancestor->id;
            $user->save();
            DB::commit();
            $msg_type = 'flash_success';
            $msg = 'Клиент перенесен под ' . $new_ancestor->email . '.';
        } catch (\Exception $e) {
            DB::rollback();
            $msg_type = 'flash_danger';
            $msg = $e->getMessage();
            Log::error($e->getMessage());
        }

        return back()->with($msg_type, $msg);
    }

    /**
     * Возвращает список дат между двумя датами
     *
     * @param Carbon $start_date
     * @param Carbon $end_date
     * @return array
     */
    private function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];

        for ($date = $start_date->copy(); $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    /**
     * Выполнить фейковые начисления
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createFakeAccrual(Request $request)
    {
        Log::info(Auth::user()->email . ' выполнил начисления ' . serialize($request->all()));
        $user = User::find($request->user_id);
        // Время, когда выполнялись начисления
        $time = '23:00';
        $start_date = new Carbon($request->start_date);
        $end_date = new Carbon($request->end_date);
        $date_range = $this->generateDateRange($start_date, $end_date);
        //try {
        if (count($date_range) > 365) {
            throw new Exception(count($date_range) . ' - слишком много дней в периоде!');
        };
        //
        DB::beginTransaction();
        foreach ($date_range as $date) {
            $day_percent = rand($request->min_day_percent * 100, $request->max_day_percent * 100) / 100;
            // Определяем баланс пользователя на дату
            $balance = $user->getBalanceOnDate($date);
            if ($balance > 0) {
                //
                $Transaction = new Transaction();
                $Transaction->user_id = $request->user_id;
                $Transaction->transaction_type_id = TransactionsTypesConsts::PROFIT_TYPE_ID;
                $Transaction->percent_on_amount = $balance;
                $Transaction->amount_usd = $balance * $day_percent / 100;
                $Transaction->balance_usd_after_transaction = $balance + $balance * $day_percent / 100;
                $Transaction->percent = $day_percent;
                $Transaction->end_period = new Carbon($date . ' ' . $time);
                $Transaction->created_at = new Carbon($date . ' ' . $time);
                $Transaction->updated_at = new Carbon($date . ' ' . $time);
                $Transaction->editor_id = Auth::user()->id;
                $Transaction->manual = true;
                $Transaction->save();
            }
        }
        DB::commit();
        $msg_type = 'flash_success';
        $msg = 'Начисления успешно выполнены!';
        /*} catch (\Exception $e) {
            DB::rollback();
            $msg_type = 'flash_danger';
            $msg = $e->getMessage();
            Log::error($e->getMessage());
        }*/

        return back()->with($msg_type, $msg);
    }

    public function invertAccountType($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $user->is_trading_account = !$user->is_trading_account;
        $user->save();

        Log::channel('actionlog')->info(Auth()->user()->email . ' изменил тип аккаунта ' . $user->email . ' на ' . ($user->is_trading_account ? 'трейдниг' : 'обычный'));

        return back();
    }

    /**
     * Выполнить перевод средств между аккаунтами
     *
     */
    public function transferBetweenAccounts(StoreTransferBetweenAccount $request)
    {
        try {
            DB::beginTransaction();

            $from_user = User::find($request->from_user_id);
            $to_user = User::where('email', $request->to_email)->firstOrFail();

            // Создаем транзакцию снятия средств при переводе
            $transaction = new Transaction;
            $transaction->user_id = $request->from_user_id;
            $transaction->transaction_type_id = TransactionsTypesConsts::TRANSFER_BETWEEN_ACCOUNTS_TYPE_ID;
            $transaction->amount_usd = -$request->amount_usd;
            $transaction->balance_usd_after_transaction = $from_user->balance_usd - $request->amount_usd;;
            $transaction->related_user_id = $to_user->id;
            $transaction->save();

            // Создаем транзакцию начисления средств при переводе
            $transaction = new Transaction;
            $transaction->user_id = $to_user->id;
            $transaction->transaction_type_id = TransactionsTypesConsts::TRANSFER_BETWEEN_ACCOUNTS_TYPE_ID;
            $transaction->amount_usd = $request->amount_usd;
            $transaction->balance_usd_after_transaction = $to_user->balance_usd + $request->amount_usd;;
            $transaction->related_user_id = $request->from_user_id;
            $transaction->save();

            Log::channel('actionlog')->info('Пользователь ' . Auth::user()->email . ' перевел $' .
                $request->amount_usd . " с аккаунта $from_user->email на аккаунт $to_user->email.");

            DB::commit();
            $msg_type = 'flash_success';
            $msg = 'Средства успешно переведены.';
        } catch (\Exception $e) {
            DB::rollback();
            $msg_type = 'flash_danger';
            $msg = $e->getMessage();
            Log::error($e->getMessage());
        }

        return back()->with($msg_type, $msg);
    }

    public function changePercent(Request $request)
    {
        $param = Config::where('name', 'min_arbitrage_percent')->firstOrFail();
        $param->value = $request->min;
        $param->save();

        $param = Config::where('name', 'max_arbitrage_percent')->firstOrFail();
        $param->value = $request->max;
        $param->save();

        Log::channel('actionlog')->info('Пользователь ' . Auth::user()->email . " изменил проценты по арбитражу: min=$request->min%, max=$request->max%.");

        return back()->with('flash_success', 'Процент успешно изменен.');
    }


    /**
     * Устанавливает вручную заданные проценты следующих начислений.
     */
    public function setManualAccrualPercents(Request $request)
    {
        foreach ($request->except('_token') as $id => $parameter) {
            // обработка диапазонв 0.1:0.2
            if (is_numeric($id)) {
                if ($parameter) {
                    $parameter = str_replace(',', '.', trim($parameter));
                    if (strstr($parameter, ':')) {
                        $parameter = explode(':', $parameter);
                        $parameter[0] = (float)$parameter[0];
                        $parameter[1] = (float)$parameter[1];
                        if ($parameter[0] > $parameter[1]) {
                            $parameter[1] = $parameter[0];
                        }
                        $parameter = "{$parameter[0]}:{$parameter[1]}";
                    } else {
                        if (is_numeric($parameter)) {
                            $parameter = (float)$parameter;
                            $parameter = "$parameter:$parameter";
                        } else {
                            $parameter = null;
                        }
                    }
                } else {
                    $parameter = null;
                }
                $plan = MarketingPlan::find($id);
                $plan->manual_percent = $parameter;
                $plan->save();
            }
        }
        Log::channel('actionlog')->info('Пользователь ' . Auth::user()->email . " изменил проценты по начислениями: " . serialize($request->except('_token')));

        return back()->with('flash_success', 'Успешно.');
    }

    /**
     * Инвертирует статус пользователя - может он или нет создавать заявки на вывод по криптовалюте.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function revertCanWithdrawalCrypto(Request $request)
    {
        $user = User::find($request->user_id);
        $user->is_allow_withdraw_crypto = !$user->is_allow_withdraw_crypto;
        $user->save();

        return back()->with('flash_success', 'Успешно.');
    }

    /**
     * Инвертирует статус пользователя - может он или нет создавать заявки на вывод.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function revertCanWithdrawalStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->can_confirm_withdrawal = !$user->can_confirm_withdrawal;
            $user->save();

        return back()->with('flash_success', 'Успешно.');
    }

    public function showCryptoRequestsPage(){
        $crypto_requests = Transaction::where('transaction_type_id', TransactionsTypesConsts::INVEST_COIN_REQUEST_TYPE_ID)
            ->orderBy('id', 'desc')
            ->get();

        $crypto_requests->load('user', 'wallet', 'wallet.currency');
        return view('admin.crypto-requests')->with('crypto_requests', $crypto_requests);
    }

    public function confirmCrypto(Transaction $id){
        try {
            DB::beginTransaction();

            // Изменяем тип транзакции с "Заявки на ввод" на "Вывод".
            $id->transaction_type_id = TransactionsTypesConsts::INVEST_COIN_TYPE_ID;
            $id->editor_id = Auth::user()->id;
            $id->save();

            $code = strtolower($id->currency->code);
            $codeBalans = 'balance_'.$code;

            $user = User::find($id->user_id);
            $user->$codeBalans += $id->amount_crypto; // Заявка на ввод с "-", поэтому будет сложение
            $user->save();

            $alert              = new Alert;
            $alert->user_id     = $id->user_id;
            $alert->alert_id    = AlertType::INVEST_COIN;
            $alert->amount      = $id->amount_crypto;
            $alert->currency_id = $id->currency_id;
            $alert->currency_type = $code;
            $alert->save();

            Log::channel('actionlog')->info(Auth()->user()->email . '(id=' . Auth()->user()->id . ') подтвердил ввод средств id=' . $id->id . ' ' . serialize($id));

            // Если инвестированная после вывода сумма меньше, чем необходимая для текущего плана — план автоматически понижается.
            // т.е. если баланс пользователя меньше стоимости текущего плана - понижаем план

            UserPaymentDetail::where('transaction_id', $id->id)->update(['address'=>'Confirmed']);

            $code       = $id->currency->code;
            $codeAmount = 'amount_'.strtolower($code);

            $user = User::find($id->user_id);

            $data = [
                'amount' => $id->$codeAmount,
                'code'   => $code,
                'currency_id'   => $id->currency->id,
            ];
            $user->notify(new Deposit($data));

            DB::commit();
            $msg_type = 'flash_success';
            $msg = 'Вывод средств проведен.';
        } catch (\Exception $e) {
            DB::rollback();
            $msg_type = 'flash_danger';
            $msg = $e->getMessage();
            Log::error($e->getMessage());
        }

        return back()->with($msg_type, $msg);
    }

    public function deleteConfirmCrypto(Transaction $id){

        try {
            DB::beginTransaction();

            $code = strtolower($id->currency->code);
            $codeAmount = 'amount_'.$code;

            $alert                = new Alert;
            $alert->user_id       = $id->user_id;
            $alert->alert_id      = AlertType::INVEST_COIN_REMOVE;
            $alert->amount        = $id->$codeAmount;
            $alert->currency_id   = $id->currency_id;
            $alert->currency_type = $code;
            $alert->save();

            UserPaymentDetail::where('transaction_id', $id->id)->update(['address'=>'Canceled']);

            $id->editor_id = Auth::user()->id;
            $id->delete();


            DB::commit();

            $msg_type = 'flash_success';
            $msg = 'Заявка на ввод удалена.';
        } catch (\Exception $e) {
            DB::rollback();
            $msg_type = 'flash_danger';
            $msg = $e->getMessage();
            Log::error($e->getMessage());
        }

        return back()->with($msg_type, $msg);
    }

    /**
     * Открыть заявки на статусы
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function regionalRepresentativeRequests()
    {
        $pagination = UserStatusRequest::query()
            ->leftJoin('user_statuses', 'user_statuses.id', '=', 'user_status_requests.user_status_id')
            ->leftJoin('users', 'users.id', '=', 'user_status_requests.user_id')
            ->orderByRaw("created_at desc, FIELD(request_status, '" . UserStatusRequest::STATUS_WAIT . "','" . UserStatusRequest::STATUS_REJECT . "','" . UserStatusRequest::STATUS_CONFIRM . "')")
            ->select([
                'user_status_requests.id',
                'user_status_requests.created_at',
                'user_status_requests.request_status',
                'user_status_requests.extra_data',
                'user_statuses.name as status_name',
                'users.name as user_name',
                'users.email as user_email',
            ])
            ->paginate(100);

        // На фронте нет реальной пагинации

        $items = [];

        foreach ($pagination->items() as &$item) {
            $item->status_name = __($item->status_name);
            $item->original_request_status = $item->request_status;
            $item->request_status = trans("base.request_statuses.{$item->request_status}");

            $items[] = $item->toArray();

            unset($item);
        }

        $currentPage = $pagination->currentPage();
        $nextPage = $pagination->hasMorePages()
            ? $currentPage + 1
            : null;

        return view('admin.user-status-requests', [
            'previous_page' => $currentPage - 1,
            'current_page' => $currentPage,
            'next_page' => $nextPage,
            'last_page' => $pagination->lastPage(),
            'per_page' => $pagination->perPage(),
            'total' => $pagination->total(),
            'from' => $pagination->firstItem(),
            'to' => $pagination->lastItem(),
            'items' => $items,
        ]);
    }

    /**
     * Подтвердить заявку пользователя на статус
     *
     * @param UserStatusRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function confirmRegionalRepresentativeRequest(UserStatusRequest $request)
    {
        $request->confirm();

        return redirect()->back()->with('status', "Статус для пользователя {$request->user->name} подтвержден");
    }

    /**
     * Отклонить заявку пользователя на статус
     *
     * @param UserStatusRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function rejectRegionalRepresentativeRequest(UserStatusRequest $request)
    {
        $request->reject();

        return redirect()->back()->with('status', 'Заявка на статус отклонена');
    }

    /**
     * Переключить статус пользователю
     *
     * @param User $user
     * @param UserStatus $status
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function toggleStatus(User $user, UserStatus $status)
    {
        switch ($status->id) {
            case UserStatus::STATUS_REGIONAL_REPRESENTATIVE:
                if (!optional($user->userBonus)->is_regional_representative_status_available) {
                    throw new \Exception("У текущего пользователя нет доступа к данному статусу");
                }

                $user->update(['is_regional_representative' => !$user->is_regional_representative]);

                break;
            default:
                throw new \Exception("Переключение этого статуса (id: {$status->id}) не настроено");
        }

        return redirect()->back()->with('status', 'Статус пользователя изменен');
    }

    public function invitationDeposits(Request $request)
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        if (!$dateFrom || !$dateTo) {
            $dateFrom = Carbon::now()->subWeek()->toDateString();
            $dateTo = Carbon::now()->toDateString();
        }

        $pagination = UserMarketingPlan::query()
            ->leftJoin('users', 'users.id', '=', 'user_marketing_plans.user_id')
            ->leftJoin('users as from_users', 'from_users.id', '=', 'user_marketing_plans.from_user_id')
            ->where('marketing_plan_id', MarketingPlan::MP_USD_INVITATION)
            ->whereDate('user_marketing_plans.created_at', '>=', $dateFrom)
            ->whereDate('user_marketing_plans.created_at', '<=', $dateTo)
            ->orderByDesc('user_marketing_plans.created_at')
            ->select([
                'users.name as user_name',
                'users.email as user_email',
                'from_users.name as from_user_name',
                'from_users.email as from_user_email',
                'user_marketing_plans.id',
                'user_marketing_plans.invested_usd',
                'user_marketing_plans.created_at',
            ])
            ->paginate(100);

        // На фронте нет реальной пагинации

        $currentPage = $pagination->currentPage();
        $nextPage = $pagination->hasMorePages()
            ? $currentPage + 1
            : null;

        return view('admin.invitation-deposits', [
            'previous_page' => $currentPage - 1,
            'current_page' => $currentPage,
            'next_page' => $nextPage,
            'last_page' => $pagination->lastPage(),
            'per_page' => $pagination->perPage(),
            'total' => $pagination->total(),
            'from' => $pagination->firstItem(),
            'to' => $pagination->lastItem(),
            'items' => $pagination->items(),
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ]);
    }

    public function showUserPackagesStatisticsPage(Request $request) : View
    {
        // Статистика по пакетам
        $user = User::where('email', $request->route('email'))->first();
        $statsService = new UserPackagesInfoService($user->id);
        $packagesStatistics = $statsService->geStatistics();
        $debt = $statsService->getAllDebt();
        return view('admin.client-packages-statistics', compact('packagesStatistics', 'user', 'debt'));
    }
}
