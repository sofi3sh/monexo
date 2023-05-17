<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Models\Admin\Config;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Currency;
use App\Models\Home\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Home\CryptocurrencyExchange;
use App\Models\Home\ArbitrageTrading;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\RateControllerMultiplyExchanges;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Jobs\SellArbitrationOrder;
use Illuminate\Support\Facades\Log;
use App\Models\Home\ArbitrageTradingPlan;
use App\Http\Requests\Backend\Arbitrage\BuyArbitragePlan;
use App\Http\Requests\Backend\Arbitrage\CreateArbitrage;

class ArbitrageController extends Controller
{
    public function showArbitragePage()
    {
        // Если есть активный план, проверяем, не закончилось ли действие плана, если закончилось - закрываем план
        if (!is_null(Auth::user()->arbitrage_trading_plan_id) && Auth::user()->isTradingPlanIsEnd()) {
            Auth::user()->arbitrage_trading_plan_id = null;
            Auth::user()->arbitrage_trade_days_left = null;
            Auth::user()->start_arbitrage_plan_at = null;
            Auth::user()->first_day_arbitrage_at = null;
            Auth::user()->save();
        }

        // Если с момента первого торга прошло более суток - обнуляем время первого торга и кол-во проведенных торгов.
        $now = Carbon::now();
        if (!is_null(Auth::user()->first_day_arbitrage_at) && ($now->diffInHours(Auth::user()->first_day_arbitrage_at) >= 24)) {
            Auth::user()->first_day_arbitrage_at = null;
            Auth::user()->executed_arbitrage_count = 0;
            Auth::user()->save();
        }

        //
        $cryptocurrency_exchanges = CryptocurrencyExchange::where('in_arbitrage_trading', 1)->get();
        $arbitrage_trading_cryptocurrencies = Currency::where('in_arbitrage_trading', 1)->get();

        $active_arbitrage = Auth::user()->getActiveArbitrageTrading();
        //$available_count = 12; // todo Еще надо передавать доступное количество операций. Делать недоступным выполнение арб. торговли, если 0.

        $will_be_completed_at = null;
        // Костыль
        $is_result_shown = true;
        // Длительность проведения арбитражной торговли
        $duration_of_arbitrage_trading = is_null(Auth()->user()->arbitrageTradingPlan) ? 0 : Auth()->user()->arbitrageTradingPlan->transaction_duration;
        
        // Правки от Юры
        // Максимальное количество сделок по активному плану
        $max_deals_count = is_null(Auth()->user()->arbitrageTradingPlan) ? 0 : Auth()->user()->arbitrageTradingPlan->max_operation_count;
        // Максимальная допустимая сумма сделки
        $max_deals_sum   = is_null(Auth()->user()->arbitrageTradingPlan) ? 0 : Auth()->user()->arbitrageTradingPlan->max_sum;

        
        // Если есть активная арбитражная торговля
        if (!is_null($active_arbitrage)) {
            // Высчитываем, когда должна быть завершена открытая арбитражная торговля
            $start = Carbon::parse($active_arbitrage->start);
            $will_be_completed_at = $start->addSeconds($duration_of_arbitrage_trading);
        } else { // Нет активных ставок
            // Проверяем, есть ли не показанные результаты торгов
            $r = ArbitrageTrading::where('user_id', Auth::user()->id)
                ->whereNotNull('end')
                ->where('is_result_shown', 0)->first();
            if (!is_null($r)) { // Есть не показанные результаты
                $active_arbitrage = $r;
                // Ставим флаг, что показали результаты
                $r->is_result_shown = true;
                $r->save();
                $is_result_shown = false;
            };
        }

        $last_operation = ArbitrageTrading::where('user_id', Auth::user()->id)->latest()->first();

        // Предлагаемые планы арбитражной торговли
        $arbitrage_trading_plans = ArbitrageTradingPlan::all();

        // Список выполненных арбитражных ставок
        $arbitrage_tradings = ArbitrageTrading::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $arbitrage_tradings->load('currency');
        //dd($arbitrage_tradings);

        
        return view('backend.pages.arbitrage')->with([
            'user'                               => Auth::user(),
            'arbitrage_on_of'                    => config('finance.arbitrage_on_of'),
            'active_arbitrage'                   => $active_arbitrage,
            'is_result_shown'                    => $is_result_shown,
            'will_be_completed_at'               => $will_be_completed_at,
            //'available_count'                    => $available_count,
            'cryptocurrency_exchanges'           => $cryptocurrency_exchanges,
            'arbitrage_trading_cryptocurrencies' => $arbitrage_trading_cryptocurrencies,
            'arbitrage_trading_plans'            => $arbitrage_trading_plans,
            'last_operation'                     => $last_operation,
            'arbitrage_tradings'                 => $arbitrage_tradings,
            'arbitrage_time'                     => $duration_of_arbitrage_trading,
            'max_deals_count'                    => $max_deals_count,
            'max_deals_sum'                      => $max_deals_sum,
        ]);
    }

    /**
     * Создание ставки арбитражной торговли
     *
     * @param Request $request
     * @param CreateArbitrage $arbitrage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createArbitrage(Request $request, CreateArbitrage $arbitrage)
    {
        // Если есть активная ставка - выходим
        if (!is_null(Auth::user()->getActiveArbitrageTrading())) {
            exit;
        };
        // id и обозначение криптовалюты, выбранной пользователем
        $currency_id = json_decode($request->currency)->id;
        $currency_code = json_decode($request->currency)->code;
        //
        try {
            DB::beginTransaction();

            $rateControllerMultiplyExchanges = new RateControllerMultiplyExchanges;
            $min_rate = $rateControllerMultiplyExchanges->getMinRate($currency_code);
            $exchange = CryptocurrencyExchange::where('name', $min_rate[0])->first();
            // Создаем ордер арбитражной торговли
            $arbitrage_trading = new ArbitrageTrading();
            // Данные, введенные пользователем
            $arbitrage_trading->amount_usd = $request->amount_usd;
            $arbitrage_trading->currency_id = $currency_id;
            // Остальные данные созданной арбитражной торговли
            $arbitrage_trading->user_id = Auth::user()->id;
            $arbitrage_trading->start = Carbon::now();
            // Читаем курсы и определяем на какой бирже самый низкий курс криптовалюты currency_id
            $arbitrage_trading->buy_cryptocurrency_exchange_id = $exchange->id;
            $arbitrage_trading->buy_rate = $min_rate[1];
            $arbitrage_trading->amount_usd = $request->amount_usd;
            $arbitrage_trading->save();

            // Если за последние сутки арбитражная торговля не выполнялась
            if (is_null(Auth::user()->first_day_arbitrage_at)) {
                // Сохраняем время первой за сутки арбитражной торговли
                Auth::user()->first_day_arbitrage_at = Carbon::now();
                // Уменьшаем кол-во доступных дней
                Auth::user()->decrement('arbitrage_trade_days_left');
            }
            // Увеличиваем кол-во выполненных операций
            Auth::user()->increment('executed_arbitrage_count');
            Auth::user()->save();

            DB::commit();
            $msg_type = 'flash_success';
            $msg = 'Ставка успешно создана.';

            // Длительность проведения арбитражной торговли
            $transaction_duration = Auth()->user()->arbitrageTradingPlan->transaction_duration;
            // Помещаем в очередь задачу с закрытием ставки (чуть раньше, чем обновится страница)
            SellArbitrationOrder::dispatch(Auth::user())->delay(now()->addSeconds($transaction_duration - 2));
        } catch (\Exception $e) {
            DB::rollback();
            $msg_type = 'flash_danger';
            $msg = 'Ошибка при создании ставки.';
            Log::error('Ошибка в sellArbitrageOrder: ' . $e->getMessage() . '. Пользователь: ' . Auth::user()->email . ' id(' . Auth::user()->id . ')');
        }

        return back()->with($msg_type, $msg);
    }

    /**
     * Вычисляет прибыль или убытки согласно заданных % ограничений
     *
     * @param $active_arbitrage_trading
     * @param float $sell_rate
     * @return float|int|string
     */
    public function profitAveraging($active_arbitrage_trading, float $sell_rate)
    {
        // Процент прибыльности сделки: (продали-купили)/купили
        // Купили по 8, продали по 10: (10-8)/8*100=25%
        // Купили по 10, продали по 8: (8-10)/10*100=-20%
        $profit_percentage = ($sell_rate - $active_arbitrage_trading->buy_rate) / $active_arbitrage_trading->buy_rate * 100;

        $arbitrage_spred_min_max_percent_profit = (float)config('finance.arbitrage_spred_min_max_percent_profit');
        $min_arbitrage_percent = (float)Config::where('name', 'min_arbitrage_percent')->first()->value;
        $max_arbitrage_percent = (float)Config::where('name', 'max_arbitrage_percent')->first()->value;

        $comment = 'Операция продажи арбитража (id=' . $active_arbitrage_trading->id . ') для user_id=' . $active_arbitrage_trading->user_id .
            '. Реальный процент ' . round($profit_percentage,2) . "%. Заданный разброс $arbitrage_spred_min_max_percent_profit%" .
            " Заданная мин. прибыль: " . $min_arbitrage_percent . "%. Заданная макс. прибыль: " . $max_arbitrage_percent . "%. ";
        if ($profit_percentage < $min_arbitrage_percent) {
            $rnd = rand(0, $arbitrage_spred_min_max_percent_profit*100)/100;
            $profit_percentage = $min_arbitrage_percent + $rnd;
            $comment .= " Процент ниже минимального. Принимаем $profit_percentage%. (Разброс $rnd%)";
        } elseif ($profit_percentage > $max_arbitrage_percent) {
            $rnd = rand(0, $arbitrage_spred_min_max_percent_profit*100)/100;
            $profit_percentage = $max_arbitrage_percent - $rnd;
            $comment .= " Процент больше максимального. Принимаем $profit_percentage%. (Разброс $rnd%)";
        }
        Log::channel('actionlog')->info($comment);

        return $profit_percentage;
    }

    /**
     * Выполнить продажу купленного ордера
     *
     */
    public function sellArbitrageOrder(User $user = null)
    {
        $user = $user ?? Auth::user();
        $active_arbitrage_trading = $user->getActiveArbitrageTrading();
        //
        $rateControllerMultiplyExchanges = new RateControllerMultiplyExchanges;
        $max_rate = $rateControllerMultiplyExchanges->getMaxRate($active_arbitrage_trading->currency->code);
        $exchange = CryptocurrencyExchange::where('name', $max_rate[0])->first();
        try {
            DB::beginTransaction();

            // Обновляем ордер арбитражной торговли
            $active_arbitrage_trading->sell_cryptocurrency_exchange_id = $exchange->id;
            $sell_rate = $this->profitAveraging($active_arbitrage_trading, $max_rate[1]);
            $active_arbitrage_trading->sell_rate = $active_arbitrage_trading->buy_rate * (1 + ($sell_rate / 100));
            $active_arbitrage_trading->profit_usd = $active_arbitrage_trading->profitUsd();
            $commission = (float)config('finance.service_arbitrage_commission');
            $active_arbitrage_trading->user_profit_usd = $active_arbitrage_trading->calcUserProfitUsd($commission);
            $active_arbitrage_trading->end = Carbon::now();
            $active_arbitrage_trading->save();

            // Создаем финансовую транзакцию, если сумма операции больше 0.01
            if (abs($active_arbitrage_trading->user_profit_usd) >= 0.01) {
                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->transaction_type_id = TransactionsTypesConsts::ARBITRAGE_TRADING_INCOME_TYPE_ID;
                $transaction->amount_usd = $active_arbitrage_trading->user_profit_usd;
                $transaction->balance_usd_after_transaction = $user->balance_usd + $active_arbitrage_trading->user_profit_usd;
                $transaction->save();
            }
            //
            DB::commit();
            $msg_type = 'flash_success';
            $msg = 'Ставка успешно создана.';
        } catch (\Exception $e) {
            DB::rollback();
            // Удаляем в базе операцию арбитражной торговли
            $active_arbitrage_trading->delete();
            //todo Важно - везде добавить
            Log::error('Ошибка в sellArbitrageOrder: ' . $e->getMessage() . '. Пользователь: ' . $user->email . ' id(' . $user->id . ')');
            \Session::flash('error', $e->getMessage());
        }
    }

    /**
     * Покупка плана арбитражной торговли.
     *
     * @param BuyArbitragePlan $request
     * @param ArbitrageTradingPlan $arbitrage_trading_plan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function buyArbitrage(BuyArbitragePlan $request, ArbitrageTradingPlan $arbitrage_trading_plan)
    {
        try {
            DB::beginTransaction();

            Auth::user()->arbitrage_trading_plan_id = $arbitrage_trading_plan->id;
            Auth::user()->start_arbitrage_plan_at = Carbon::now();
            Auth::user()->save();

            // Создаем транзакцию покупки плана арбитражной торговли
            $transaction = new Transaction();
            $transaction->user_id = Auth::user()->id;
            $transaction->transaction_type_id = TransactionsTypesConsts::BUY_ARBITRAGE_TRADING_PLAN_TYPE_ID;
            $transaction->amount_usd = -$request->price;
            $transaction->balance_usd_after_transaction = Auth::user()->balance_usd - $transaction->amount_usd;
            $transaction->save();

            // Если пригласивший текущего пользователя тоже имеет купленный арбитражный план - начисляем ему бонус
            $ancestor = User::where('id', Auth::user()->parent_id)->first();

            // Если пользователь имеет родителя и у родителя есть купленный трейдинг-план
            if (!is_null($ancestor) && (!is_null($ancestor->arbitrage_trading_plan_id))) {
                $transaction = new Transaction();
                $transaction->user_id = $ancestor->id;
                $transaction->transaction_type_id = TransactionsTypesConsts::BONUS_FOR_REFERRAL_BUY_ARBITRAGE_PLAN_TYPE_ID;
                $transaction->amount_usd = $request->price * 0.35;
                $transaction->balance_usd_after_transaction = $ancestor->balance_usd + $transaction->amount_usd;
                $transaction->save();
            }

            // Заполняем у пользователя доступное кол-во дней арбитражной торговли
            Auth::user()->arbitrage_trade_days_left = $arbitrage_trading_plan->duration;
            Auth::user()->save();

            DB::commit();
            Log::channel('actionlog')->info(Auth()->user()->email . ' (id=' . Auth()->user()->id . ') приобрел план арбитражной торговли: ' .
                $arbitrage_trading_plan->name_ru . '(id=' . $arbitrage_trading_plan->id . ')');
            $msg_type = 'flash_success';
            $msg = 'План арбитражной торговли успешно приобретен.';
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            $msg_type = 'flash_danger';
            $msg = 'Ошибка покупки плана арбитражной торговли.';
        }

        return back()->with($msg_type, $msg);
    }
}
