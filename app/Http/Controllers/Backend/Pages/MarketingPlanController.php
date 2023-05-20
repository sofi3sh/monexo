<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\MarketingPlan\InvestToMarketingPlanRequest;
use App\Http\ViewModels\Backend\TransactionsFormViewModel;
use App\Models\Consts\AlertType;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Alert;
use App\Models\Home\Bonus;
use App\Models\Home\MarketingPlan;
use App\Models\Home\MarketingPlanPartner;
use App\Models\Home\Transaction;
use App\Models\Home\UserMarketingPlan;
use App\Models\User;
use App\Notifications\AccrueBonus;
use App\Notifications\BuyPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class MarketingPlanController extends Controller
{
    /**
     * Показать страницу маркетинговых планов
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(TransactionsFormViewModel $viewModel)
    {
        // получение новых пакетов, разбитых на группы
        $marketingPlanGroups = MarketingPlan::getGroups();


        $marketingPlans = UserMarketingPlan::with('marketingPlan')->where('user_id', Auth()->user()->id)->get();
        // получение активного маркетингово плана из группы Standard (используется для апгрейда)
        $userMarketingPlanStandardActive = $this->getUserActivePlanByGroup(MarketingPlan::GROUP_STANDARD);

        // получение активного маркетингово плана из группы Business (используется для апгрейда)
        $userMarketingPlanBusinessActive = $this->getUserActivePlanByGroup(MarketingPlan::GROUP_BUSINESS);

        // Если пакет бизнесс уже открыт то уменьшим сумму минимальной доинвестиции
        //if ( isset( $userMarketingPlanBusinessActive ) ) {
        //    foreach ($marketingPlanGroups['packages']['Business'] as &$packageBusiness) {
        //        $packageBusiness->min_invest_sum = 100;
        //    }
        //}


        return view('dashboard.investments', compact(
            'marketingPlans',
            'marketingPlanGroups',
             'userMarketingPlanStandardActive',
            'userMarketingPlanBusinessActive'
        ));
    }

    /**
     * Получение активного пакета Standard
     *
     * @param string $group
     * @return UserMarketingPlan|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed|null
     */
    private function getUserActivePlanByGroup(string $group)
    {
        $marketingPlans = UserMarketingPlan::with('marketingPlan')->where('user_id', Auth()->user()->id)->get();
        // получение активного маркетингово плана из группы Standard
        // (используется для апгрейда)
        foreach ($marketingPlans as $marketingPlan) {
            if ($marketingPlan->marketingPlan->isNewByIdAndName($group) && $marketingPlan->isActive()) {
                return $marketingPlan;
            }
        }

        return null;
    }

    /**
     * Вывод средств с пакета
     *
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function withdrawPackageProfit(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
        ]);

        $userMarketingPlan = UserMarketingPlan::find((int)$request->get('id'));

        if (
            $userMarketingPlan &&
            $userMarketingPlan->user_id === Auth::user()->id && (
                $userMarketingPlan->marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_BUSINESS) ||
                $userMarketingPlan->marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_CRYPTO_BUSINESS) ||
                $userMarketingPlan->marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_LIGHT) ||
                $userMarketingPlan->marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_NEW_LIGHT)
            )
        ) {
            $userMarketingPlan->withdrawProfit();
            return redirect()->back()->with(['flash_success' => trans('base_attention.withdrawal.pack_to_balance_success')]);
        }

        abort(404);
    }

    public static function createMarketingPlan(User $user, MarketingPlan $marketingPlan, float $investedUSD, int $daysDiff = 0, float $discountUSD = 0, int $parentId = 1)
    {
        // Увеличим сумму инвестиций пользователя.
        $user->invested_usd += $investedUSD;
        $user->save();

        // Создадим маркетинговый план.
        $userMarketingPlan                      = new UserMarketingPlan();
        $userMarketingPlan->user_id             = $user->id;
        $userMarketingPlan->marketing_plan_id   = $marketingPlan->id;
        $userMarketingPlan->balance_usd         = 0;
        $userMarketingPlan->days_left           = $marketingPlan->max_duration - $daysDiff;
        $userMarketingPlan->invested_usd        = $investedUSD + $discountUSD;
        $d = Carbon::now()->diffInHours(Carbon::today(),true);
        if ( $d <= 18 ) {
            $userMarketingPlan->start_at = Carbon::now();
        }
        if ( $parentId !== 1 ) {
            $userMarketingPlan->from_user_id = $parentId;
        }
        $userMarketingPlan->save();

        // Создадим оповещение.
        $alert                    = new Alert;
        $alert->user_id           = Auth()->user()->id;
        $alert->alert_id          = AlertType::OPENING_INVESTMENT;
        $alert->marketing_plan_id = $marketingPlan->id;
        $alert->amount            = $investedUSD;
        $alert->save();
    }

    public function invest(Request $request)
    {
        $this->validate($request, [
            'invest_usd' => 'required|integer|min:1|max:999999',
            'marketing_plan_id' => 'required|integer',
        ]);

        $marketing_plan = MarketingPlan::find($request->marketing_plan_id);
        $invest_usd     = $request->invest_usd;

        if(!$marketing_plan) return redirect()->back();
        // Временно скрыт план "New Light"
        if($marketing_plan->id == 27) return redirect()->back();

        // если есть активный пакет Standard и текущий активируемый пакет тоже Standard, то будет выполнен апгрейд
        $userMarketingPlanActive = null;

        // скидка с учетом активного пакета
        $discountUSD = 0;

        // количество дней нового пакета, которое нужно отнять
        $daysDiff = 0;

        // если новый пакет типа Standard
        if ($marketing_plan->isNewByIdAndName(MarketingPlan::GROUP_STANDARD)) {
            $userMarketingPlanActive = $this->getUserActivePlanByGroup(MarketingPlan::GROUP_STANDARD);

            // если есть активный пакет типа Standard
            if ($userMarketingPlanActive) {

                // скидка с учетом активного пакета
                $discountUSD = $userMarketingPlanActive->marketingPlan->max_invest_sum;

                // стоимость одного дня нового пакета
                $newDayCost = $marketing_plan->daily_percent / 100 * $marketing_plan->max_invest_sum;

                // стоимость одного дня активного пакета
                $activeDayCost = $userMarketingPlanActive->marketingPlan->daily_percent /
                    100 * $userMarketingPlanActive->marketingPlan->max_invest_sum;

                // текущий день активного пакета
                $activeDaysPeriod = $userMarketingPlanActive->marketingPlan->max_duration -
                    $userMarketingPlanActive->days_left;

                // количество дней нового пакета, которое нужно отнять
                $daysDiff = round($activeDayCost * $activeDaysPeriod / $newDayCost);

                if ($userMarketingPlanActive->days_left <= 30) {
                    return redirect()->back()->withErrors(__('website_home.package.error_30_days_end'));
                }
            }
        } elseif ($marketing_plan->isNewByIdAndName(MarketingPlan::GROUP_BUSINESS)) {
            $userMarketingPlanActive = $this->getUserActivePlanByGroup(MarketingPlan::GROUP_BUSINESS);

            // если есть активный пакет типа Business
            if ($userMarketingPlanActive) {

                // скидка с учетом активного пакета
                $discountUSD = $userMarketingPlanActive->invested_usd;

                // количество дней нового пакета, которое нужно отнять
                $daysDiff = $userMarketingPlanActive->marketingPlan->max_duration - $userMarketingPlanActive->days_left;

                if ($userMarketingPlanActive->days_left <= 30) {
                    return redirect()->back()->withErrors(__('website_home.package.error_30_days_end'));
                }
            }
        }

        // todo:
        // переменную скидки возможно убрать и просто изменить сумму мин/макс инвестиции и в интерфейсе вывести максимальную,
        // но по идее это делать не нужно, потому что новый пакет должен будет создаться с полной суммой, чтобы
        // процент начислялись на полную сумму нового пакета
        if ( Auth()->user()->balance_usd < $invest_usd ) {
            return redirect()
                ->back()
                ->withErrors(__('website_home.package.error_not_enough_money', ['currency' => 'USD']));
        }

        if (($invest_usd + $discountUSD) < $marketing_plan->min_invest_sum || ($invest_usd + $discountUSD) > $marketing_plan->max_invest_sum) {
            return redirect()
                ->back()
                ->withErrors(__('website_home.package.error_format_money'));
        }

        try {
            DB::beginTransaction();
            if ($userMarketingPlanActive) {
                if (!$userMarketingPlanActive->marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_STANDARD)) {
                    $userMarketingPlanActive->withdrawProfit();
                }
                $userMarketingPlanActive->stop();
            }

            $user = Auth::user();
            self::createMarketingPlan($user, $marketing_plan, $invest_usd, $daysDiff, $discountUSD);


            $parents = $user->getAllParents();
            $i = 0;
            foreach($parents as $p){
                // уведомляем партнера, что реферал купил пакет
                $alert                = new Alert;
                $alert->user_id       = $p['id'];
                $alert->alert_id      = AlertType::PARTNER_REPLENISHMENT;
                $alert->email         = $user->email;
                $alert->amount        = $request->invest_usd;
                $alert->save();

                // если у партнера нет активного пакета, то он не получает реферальные
                $refUser = User::find($p['id']);
                if ($refUser && !$refUser->userMarketingPlan()->exists()) {
                    continue;
                }

                $transaction = new Transaction();
                $transaction->user_id = $p['id'];
                $transaction->transaction_type_id = TransactionsTypesConsts::PROFIT_FROM_PARTNER_PROGRAM;
                $transaction->amount_usd = $request->invest_usd/100 * $p['key'];
                $transaction->balance_usd_after_transaction = $transaction->amount_usd;
                // Old
                // $transaction->balance_usd_after_transaction = $userMarketingPlan->balance_usd + $transaction->amount_usd;
                $transaction->line_number = $i; $i++;
                $transaction->save();

                $partner = new MarketingPlanPartner;
                $partner->user_id = Auth()->user()->id;
                $partner->partner_id = $p['id'];
                $partner->line_number = $i;
                $partner->invested_usd = $request->invest_usd;
                $partner->profit = $request->invest_usd/100 * $p['key'];
                $partner->save();

                $alert                = new Alert;
                $alert->user_id       = $p['id'];
                $alert->alert_id      = AlertType::ACCRUAL_OF_REFERRAL_PROFIT;
                $alert->email         = $user->email;
                $alert->amount        = $request->invest_usd/100 * $p['key'];
                $alert->save();

            }

            $this->accrueBonuses(Auth()->user()->id, $request->invest_usd);
            $this->writeOffFundsWhenInvesting($request->invest_usd ,'usd');

            Log::channel('actionlog')
                ->error('Пользователь user_id=' . Auth::user()->id . ' инвестировал в маркетинг-план: ' . serialize($request->except('_token')));
            DB::commit();

            $marketing_plan_name = '';
            if (strpos($marketing_plan->name, 'Standard') !==  false) {
                $marketing_plan_name = 'SERVER 1';
            } elseif (strpos($marketing_plan->name, 'Business') !==  false) {
                $marketing_plan_name = 'SERVER 2';
            } elseif (strpos($marketing_plan->name, 'Light') !==  false) {
                $marketing_plan_name = 'Regular';
            } elseif (strpos($marketing_plan->name, 'Mini') !==  false) {
                $marketing_plan_name = 'Random';
            }

            $data = [
                'package'      => $marketing_plan_name,
                'daily_amount' => strtoupper($marketing_plan->currency_type).' '.($request->invest_usd*$marketing_plan->daily_percent)/100,
                'percent'      => $marketing_plan->daily_percent,
                'amount'       => strtoupper($marketing_plan->currency_type).' '.$request->invest_usd,
            ];
            Auth()->user()->notify(new BuyPackage($data));

            return redirect()->back()->with(['flash_success' => trans('base_attention.marketing_plan.buy_plan', ['package'=>$marketing_plan_name])]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('actionlog')->error('Ошибка инвестирования в маркетинг-план пользователем user_id=' . Auth::user()->id .
                ' ' . $e->getMessage() . ' ' . serialize($request->except('_token')));

            return back()->with(['flash_danger' => trans('base_attention.marketing_plan.error')]);
        }
    }

    /**
     * Функция инвестирования в крипто планы
    */
    public function investCrypto(Request $request)
    {
        /* Временно скрыта возможность создавать крипто планы */
        return redirect()->back();
        /// Удалить выше, как будем возвращать крипто планы

        $this->validate($request, [
            'invest_crypto' => 'required|between:0,99.99|max:500000',
            'marketing_plan_id' => 'required|integer',
          ]);
        $marketing_plan = MarketingPlan::find($request->marketing_plan_id);

        if(!$marketing_plan) return redirect()->back();

        $invest_crypto  = $request->invest_crypto;
        $code           = $marketing_plan->currency_type;

        switch ($code) {
            case 'btc':
                $crypto = Auth()->user()->getCurrencyeUsd('bitcoin');
            break;

            case 'eth':
                $crypto = Auth()->user()->getCurrencyeUsd('ethereum');
            break;

            case 'pzm':
                $crypto = Auth()->user()->getCurrencyeUsd('prizm');
            break;
        }

        if ($request->currency_type == 'usd') {
            $investedUSD = $request->invest_crypto;
            switch ($code) {
                case 'btc':
                    $invest_crypto = $invest_crypto/$crypto;
                break;

                case 'eth':
                    $invest_crypto = $invest_crypto/$crypto;
                break;

                case 'pzm':
                    $invest_crypto = $invest_crypto/$crypto;
                break;
            }
        }else {
            $investedUSD = $request->invest_crypto*$crypto;
        }

        $codeBalans   = 'balance_'.strtolower($code);

        $codeBalansForCheck = 'balance_'.$request->currency_type;

        $codeInvested = 'invested_'.strtolower($code);
        $codeAmount = 'amount_'.strtolower($code);
        $code_balance_after_transaction = 'balance_'.strtolower($code).'_after_transaction';

        if(Auth()->user()->$codeBalansForCheck < $request->invest_crypto) return redirect()->back()->withErrors(__('website_home.package.error_not_enough_money', ['currency' => strtoupper($request->currency_type)]));

        if ($invest_crypto < $marketing_plan->min_invest_sum || $invest_crypto > $marketing_plan->max_invest_sum) return redirect()->back()->withErrors(__('website_home.package.error_format_money'));

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $user->$codeInvested += $invest_crypto;
            $user->invested_usd   += $investedUSD;

            $userMarketingPlan                    = new UserMarketingPlan();
            $userMarketingPlan->user_id           = $user->id;
            $userMarketingPlan->marketing_plan_id = $marketing_plan->id;
            $userMarketingPlan->balance_usd       = 0;
            $userMarketingPlan->$codeBalans       = $invest_crypto;
            $userMarketingPlan->days_left         = $marketing_plan->max_duration;
            $userMarketingPlan->$codeInvested     = $invest_crypto;
            $userMarketingPlan->rate              = $crypto;
            $d                                    = Carbon::now()->diffInHours(Carbon::today(),true);

            if($d <= 18) $userMarketingPlan->start_at = Carbon::now();
            $userMarketingPlan->save();
            $user->save();

            $alert                    = new Alert;
            $alert->user_id           = Auth()->user()->id;
            $alert->alert_id          = AlertType::OPENING_INVESTMENT;
            $alert->amount            = $invest_crypto;
            $alert->marketing_plan_id = $marketing_plan->id;
            $alert->currency_type     = strtolower($code);
            $alert->save();


            $parents = $user->getAllParents();
            $i = 0;
            foreach($parents as $p){
                // уведомляем партнера, что реферал купил пакет
                $alert                = new Alert;
                $alert->user_id       = $p['id'];
                $alert->alert_id      = AlertType::ACCRUAL_OF_REFERRAL_PROFIT;
                $alert->email         = $user->email;
                $alert->amount        = $invest_crypto/100 * $p['key'];
                $alert->currency_type = strtolower($code);
                $alert->save();

                // если у партнера нет активного пакета, то он не получает реферальные
                $refUser = User::find($p['id']);
                if ($refUser && !$refUser->userMarketingPlan()->exists()) {
                    continue;
                }

                $parent = User::find($p['id']);
                $parent->referrals_usd += $investedUSD/100 * $p['key'];
                $parent->save();

                $transaction = new Transaction();
                $transaction->user_id = $p['id'];
                $transaction->transaction_type_id = TransactionsTypesConsts::PROFIT_FROM_PARTNER_PROGRAM;
                $transaction->$codeAmount = $invest_crypto/100 * $p['key'];
                $transaction->$code_balance_after_transaction = $parent->$codeBalans + $invest_crypto/100 * $p['key'];
                $transaction->line_number = $i; $i++;
                $transaction->rate        = $crypto;
                if (strtolower($code) != 'usd') {
                    $transaction->amount_crypto = $investedUSD/100 * $p['key'];
                }
                $transaction->save();

                $partner                = new MarketingPlanPartner;
                $partner->user_id       = Auth()->user()->id;
                $partner->partner_id    = $p['id'];
                $partner->line_number   = $i;
                $partner->$codeInvested = $invest_crypto;
                $partner->profit        = $invest_crypto/100 * $p['key'];
                $partner->rate          = $crypto;
                $partner->save();
            }
            // $this->accrueBonuses(Auth()->user()->id, $request->invest_usd);
            $this->writeOffFundsWhenInvesting($request->invest_crypto, $request->currency_type, $crypto);

            Log::channel('actionlog')->error('Пользователь user_id=' . Auth::user()->id . ' инвестировал в маркетинг-план: ' . serialize($request->except('_token')));
            DB::commit();

            $daily = ($invest_crypto*$marketing_plan->daily_percent)/100;
            $data = [
                'package'      => $marketing_plan->name,
                'daily_amount' => strtoupper($marketing_plan->currency_type).' '.number_format($daily, 8),
                'percent'      => $marketing_plan->daily_percent,
                'amount'       => strtoupper($marketing_plan->currency_type).' '.number_format($invest_crypto, 8),
            ];
            Auth()->user()->notify(new BuyPackage($data));

            return redirect()->back()->with(['flash_success' => trans('base_attention.marketing_plan.buy_plan', ['package'=>$marketing_plan->name])]);
        }catch (\Exception $e) {
            DB::rollback();
            Log::channel('actionlog')->error('Ошибка инвестирования в маркетинг-план пользователем user_id=' . Auth::user()->id .
                ' ' . $e->getMessage() . ' ' . serialize($request->except('_token')));

            return back()->with(['flash_danger' => trans('base_attention.marketing_plan.error')]);
        }
    }

    public function reCalck($a,$b):float
    {
        $first_percent = (float)sqrt($a);
        $second_percent = (float)(0.05 * $b);
        $percent = (float)(sqrt($first_percent * $second_percent) / 10);
        $c = (float)ceil($percent * 1000) / 1000;

        $summ = (float)($a * pow((1 + ($c / 100)), $b));
        $profit = ($summ - $a)/$b;
        $everyday = ($summ/($a/100))/$b;
        return (float)$everyday;
    }

    /**
     * Покупка маркетинг-плана
     *
     * @param InvestToMarketingPlanRequest $request
     * @param UserMarketingPlan $userMarketingPlan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function buy(InvestToMarketingPlanRequest $request, UserMarketingPlan $userMarketingPlan)
    {
        DB::beginTransaction();
        try {
                $user = Auth::user();
                $user->invested_usd += $request->invested_usd;
                $mp = MarketingPlan::where('id',$request->marketing_plan_id)->first();

                $userMarketingPlan->fill(
                    $request
                        ->merge([
                            'user_id'     => Auth::user()->id,
                            'balance_usd' => 0,
                            'days_left' => $mp['min_duration'],
                        //    'balance_usd' => $request->invested_usd,
                            'start_at'    => Carbon::now(),
                        ])
                        ->except('_token'));
                $userMarketingPlan->save();
                $user->save();

            $this->writeOffFundsWhenInvesting($request->invested_usd, 'usd');

            Log::channel('actionlog')->error('Пользователь user_id=' . Auth::user()->id . ' инвестировал в маркетинг-план: ' . serialize($request->except('_token')));

            DB::commit();
            return redirect()->back()->with(['flash_success' => trans('base_attention.marketing_plan.buy_plan')]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('actionlog')->error('Ошибка инвестирования в маркетинг-план пользователем user_id=' . Auth::user()->id .
                ' ' . $e->getTraceAsString() . ' ' . serialize($request->except('_token')));

            return back()->with(['flash_danger' => trans('base_attention.marketing_plan.error')]);
        }
    }

    /**
     * Закрывает активный маркетинговый план активного пользователя
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function close()
    {
        if (!is_null(Auth::user()->userMarketingPlan2)) {
            try {
                DB::beginTransaction();
                Auth::user()->userMarketingPlan2->end_at = Carbon::now();
                Auth::user()->userMarketingPlan2->save();
                // Создаем траназкция перевода средств с маркетингового плана на основной счет
                $transaction = new Transaction();
                $transaction->user_id = Auth::user()->id;
                $transaction->transaction_type_id = TransactionsTypesConsts::TRANSFER_BODY_FROM_MARKETING_PLAN_TO_MAIN_BALANCE;
                $transaction->amount_usd = Auth::user()->userMarketingPlan2->invested_usd;
                $transaction->balance_usd_after_transaction = Auth::user()->balance_usd + Auth::user()->userMarketingPlan2->invested_usd;
                $transaction->save();
                DB::commit();
                $msg_type = 'flash_success';
                $msg =  trans('base_attention.marketing_plan.plan_close');
            } catch (\Exception $e) {
                DB::rollback();
                $msg_type = 'flash_danger';
                // todo-y Локализация
                $msg = trans('cabinet_home.plan_statistic.plan_close_error');
                Log::error($e->getMessage());
            }
        }

        // todo-y Локализация
        return back()->with($msg_type, $msg);
    }

    public function closePlanWithCommission(Request $request)
    {
        $msg_type = '';
        $msg = '';

        $marketing_plan = DB::table('user_marketing_plans')->select('user_marketing_plans.*', 'marketing_plans.currency_type', 'marketing_plans.withdrawal_commission')
            ->join('marketing_plans', function ($join) {
                $join->on('user_marketing_plans.marketing_plan_id', '=', 'marketing_plans.id')
                     ->where('marketing_plans.available_for_withdrawal', '=', 1);
            })->where('user_marketing_plans.user_id', '=', Auth()->user()->id)->where('user_marketing_plans.id', '=', $request->marketing_plan_id)
            ->first();

        if ($marketing_plan) {
            $currentUserMarketingPlan = UserMarketingPlan::find($request->marketing_plan_id);
            // todo: в будущем переделать то, что выше на нормальное получение нужной сущности сразу без джойнов
            // проверка, что выбран одинаковый пакет
            if ($currentUserMarketingPlan->id === $marketing_plan->id) {
                // если пакет Light или New Light, то останавливаем его, но не закрываем
                if ($currentUserMarketingPlan->marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_LIGHT) ||
                    $currentUserMarketingPlan->marketingPlan->isNewByIdAndName(MarketingPlan::GROUP_NEW_LIGHT)) {
                    if ($currentUserMarketingPlan->isStopped()) {
                        $msg_type = 'flash_danger';
                        $msg =  trans('cabinet_home.plan_statistic.plan_close_error');
                        return back()->with($msg_type, $msg);
                    } else {
                        $currentUserMarketingPlan->withdrawProfit();
                        $currentUserMarketingPlan->update(['days_left' => 25]);
                        $currentUserMarketingPlan->stopWithoutClose();
                        $msg_type = 'flash_success';
                        $msg =  trans('base_attention.marketing_plan.plan_close');
                        return back()->with($msg_type, $msg);
                    }
                }
            }

            $codeBalans   = 'balance_'.$marketing_plan->currency_type;
            $codeAmount   = 'amount_'.$marketing_plan->currency_type;
            $codeInvested = 'invested_'.$marketing_plan->currency_type;
            $code_balance_after_transaction = 'balance_'.$marketing_plan->currency_type.'_after_transaction';

            $commission = ($marketing_plan->$codeInvested*$marketing_plan->withdrawal_commission)/100;
            $amount     = $marketing_plan->$codeInvested-$commission;

            try {
                DB::beginTransaction();

                $test = UserMarketingPlan::where('id', $marketing_plan->id)->update(['end_at'=>Carbon::now()]);

                // Создаем траназкция перевода средств с маркетингового плана на основной счет
                $transaction = new Transaction();
                $transaction->user_id = Auth::user()->id;
                $transaction->transaction_type_id = TransactionsTypesConsts::TRANSFER_BODY_FROM_MARKETING_PLAN_TO_MAIN_BALANCE;
                $transaction->$codeAmount = $amount;
                $transaction->commission = $commission;
                $transaction->$code_balance_after_transaction = Auth::user()->$codeBalans + $amount;
                $transaction->save();

                Auth()->user()->$codeBalans += $amount;
                Auth()->user()->save();

                $alert                    = new Alert;
                $alert->user_id           = Auth()->user()->id;
                $alert->alert_id          = AlertType::CLOSE_INVESTMENT;
                $alert->amount            = $amount;
                $alert->marketing_plan_id = $marketing_plan->marketing_plan_id;
                $alert->currency_type     = $marketing_plan->currency_type;
                $alert->save();

                DB::commit();
                $msg_type = 'flash_success';
                $msg =  trans('base_attention.marketing_plan.plan_close');

            } catch (\Exception $e) {
                DB::rollback();
                $msg_type = 'flash_danger';
                // todo-y Локализация
                $msg = trans('cabinet_home.plan_statistic.plan_close_error');
                Log::error($e->getMessage());
            }
        }
        return back()->with($msg_type, $msg);
    }

    /**
     * Создает транзакции инвестирования в маркетинг-план.
     * Сначала списывает средства с баланса, а если не хватает - с баланса, инвестированного в коин.
     *
     */
    public function writeOffFundsWhenInvesting(float $investedUsd, $code = 'usd', $rate = null)
    {
        //$balances = $this->getAvailableBalanceForInvest($investedUsd);
        $codeBalance = 'balance_'.$code;
        $codeAmount = 'amount_'.$code;
        $code_balance_after_transaction = 'balance_' . $code . '_after_transaction';

        if ($code != 'usd') {
            $transaction = new Transaction;
            $transaction->user_id = Auth::user()->id;
            $transaction->transaction_type_id = TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE;
            $transaction->amount_usd = 0;
            $transaction->amount_crypto = -($rate*$investedUsd);
            $transaction->$codeAmount = -$investedUsd;
            $transaction->balance_usd_after_transaction = 0;
            $transaction->$code_balance_after_transaction = Auth::user()->$codeBalance - $investedUsd;
            $transaction->rate   = $rate;
            $transaction->save();
        }else {
            $transaction = new Transaction;
            $transaction->user_id = Auth::user()->id;
            $transaction->transaction_type_id = TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE;
            $transaction->amount_usd = -$investedUsd;
            $transaction->balance_usd_after_transaction = Auth::user()->balance_usd - $investedUsd;
            $transaction->save();
        }


       /* // Создаем транзакцию инвестирования в маркетинг с основного баланса
        if ($balances[0] <> 0) {
            $transaction = new Transaction;
            $transaction->user_id = Auth::user()->id;
            $transaction->transaction_type_id = TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_MAIN_BALANCE;
            $transaction->amount_usd = -$balances[0];
            $transaction->balance_usd_after_transaction = Auth::user()->balance_usd - $balances[0];
            $transaction->save();
        }

        // Создаем транзакцию инвестирования в маркетинг с баланса инвестирования в коин
        if ($balances[1] <> 0) {
            $transaction = new Transaction;
            $transaction->user_id = Auth::user()->id;
            $transaction->transaction_type_id = TransactionsTypesConsts::INVEST_TO_MARKETING_PLAN_FROM_COIN_BALANCE;
            $transaction->amount_usd = -$balances[1];
            $transaction->balance_usd_after_transaction = Auth::user()->balance_usd - $balances[1];
            $transaction->save();
        }*/

    }

    /**
     * Возвращает массив доступных балансов для инвестирования
     *
     * @param float $investSum Инвестируемая сумма
     * @return array Массив балансов [доступно_на_основном_счете; доступно_на_счете_инвестирования_в_коин]
     */
    public function getAvailableBalanceForInvest(float $investedUsd): array
    {
        // Если инвестируемая сумма больше, чем баланс — недостающую сумму берем из баланса коина
        if ($investedUsd >= Auth::user()->balance_usd) {
            //todo-tk Сделать логирование
            return [
                (float)Auth::user()->balance_usd,
                ($investedUsd - Auth::user()->balance_usd),
            ];
        } else {
            //todo-tk Сделать логирование
            return [
                $investedUsd,
                0,
            ];
        }
    }

    public function showCoinPage()
    {
        return view('backend.pages.marketing-plan.coin');
    }

    protected function accrueBonuses($id, $invested_usd)
    {
        $user            = User::with('ancestor')->where('id', $id)->first();
        $bonus_level     = $user->bonus_level;
        $investedUsd     = UserMarketingPlan::where('user_id', $user->id)->whereNull('end_at')->sum('invested_usd');
        $refferralIdList = $user->refferrals()->select('id')->get()->pluck('id');
        $teamInvestedUsd = UserMarketingPlan::whereIn('user_id', $refferralIdList)->whereNull('end_at')->sum('invested_usd');
        $bonuses         = Bonus::select('level')->where([['level', '>', $bonus_level],['personal_deposit', '<=', intval($investedUsd)],['team_turnover', '<=', intval($teamInvestedUsd)],['is_active', '=', 1]])->get();

        $this->accrueBonusUser($bonuses, $user);

        $userAncector    = $user->ancestor;
        $investedUsd     = UserMarketingPlan::where('user_id', $userAncector->id)->whereNull('end_at')->sum('invested_usd');
        $refferralIdList = $userAncector->refferrals()->select('id')->get()->pluck('id');
        $teamInvestedUsd = UserMarketingPlan::whereIn('user_id', $refferralIdList)->whereNull('end_at')->sum('invested_usd');
        $bonusesAncestor = Bonus::where([['level', '>', $userAncector->bonus_level],['is_active', '=', 1],['personal_deposit', '<=', intval($investedUsd)],['team_turnover', '<=', intval($teamInvestedUsd)]])->get();
        $this->accrueBonusUser($bonusesAncestor, $userAncector);
    }

    protected function accrueBonusUser($bonuses, $user)
    {
        foreach ($bonuses as $bonus) {
            if ($user->achieved_bonus_level >= intval($bonus->level)) {
                $user->bonus_level      =  floatval($bonus->level);
                $user->save();
                continue;
            }

            DB::beginTransaction();
            try {
                $transaction                                = new Transaction();
                $transaction->user_id                       = $user->id;
                $transaction->transaction_type_id           = TransactionsTypesConsts::BONUSES_TYPE_ID;
                $transaction->amount_usd                    = floatval($bonus->bonus);
                $transaction->balance_usd_after_transaction = floatval($user->balance_usd) + floatval($bonus->bonus);
                $transaction->save();

                $alert                    = new Alert;
                $alert->user_id           = $user->id;
                $alert->alert_id          = AlertType::PAYOUT_BONUS;
                $alert->amount            = floatval($bonus->bonus);
                $alert->save();

                $user->balance_usd     += floatval($bonus->bonus);
                $user->bonuses_usd     += floatval($bonus->bonus);
                $user->bonuses_deposit += intval($bonus->invitation_deposit);
                $user->bonus_level      =  floatval($bonus->level);
                $user->achieved_bonus_level = intval($bonus->level);

               /* if (floatval($bonus->matching_bonus) > 0) {
                    $matching_bonus = ($user->userProfitPartners()+$user->bonusCareer()+$user->investmentProfitCryptosUsd()+$user->userPartnersMatchingBonuses())*$bonus->matching_bonus/100;

                    $transaction                                = new Transaction();
                    $transaction->user_id                       = $user->id;
                    $transaction->transaction_type_id           = TransactionsTypesConsts::MATCHING_BONUS;
                    $transaction->amount_usd                    = $matching_bonus;
                    $transaction->balance_usd_after_transaction = $user->balance_usd + $matching_bonus;
                    $transaction->save();

                    $alert                    = new Alert;
                    $alert->user_id           = $user->id;
                    $alert->alert_id          = AlertType::MATCHING_BONUS;
                    $alert->amount            = $matching_bonus;
                    $alert->save();

                    $user->balance_usd     += $matching_bonus;
                    $user->bonuses_usd     += $matching_bonus;

                } */

                $data = [
                    'level' => $bonus->level,
                    'bonus' => '$' . number_format((float)$bonus->bonus, 2, '.', ' '),
                ];
                $user->notify(new AccrueBonus($data));

                $user->save();

                DB::commit();
            }catch (\Exception $e) {
                DB::rollback();
            }
        }
    }
}
