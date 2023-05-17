<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Home\MotivationPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Home\Transaction;
use App\Models\Consts\TransactionsTypesConsts;
use Illuminate\Support\Facades\Log;
use App\Jobs\AccrueBonusesNewMotivationSystem;
use App\Models\User;
use App\Models\Home\MotivationPlanParam;

class NewMotivationController extends Controller
{
    public function showNewMotivationPage()
    {
        $plans = MotivationPlan::all();
        $plans->load(['params']);
        
        return view('backend.pages.new-motivation.about')
            ->with(['plans' => $plans]);
    }

    public function validation(Request $request, MotivationPlan $motivation_plan)
    {
        $request->merge([
            // Общая инвестированная сумма пользователем
            'invested_usd' => Auth::user()->invested_usd,
            // Баланс пользователя
            'balance_usd'  => Auth::user()->balance_usd,
        ]);

        $rules = [
            'invested_usd' => 'gte:' . ($motivation_plan->min_invest_sum),
            'balance_usd'  => 'gte:' . ($motivation_plan->price),
        ];

        $messages = [
            'invested_usd.gte' => 'Инвестированная Вами сумма меньше, чем необходима для покупки выбранного плана.',
            'balance_usd.gte'  => 'Ваш баланс меньше, чем стоимость выбранного плана.'
        ];

        $this->validate($request, $rules, $messages);
    }

    /**
     * Создает транзакцию покупки плана
     *
     * @param User $user Пользователь, покупающий план
     * @param float $plan_price Стоимость плана
     */
    public function createBuyTransaction(User $user, float $plan_price)
    {
        // Создаем транзакцию покупки плана
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->transaction_type_id = TransactionsTypesConsts::BUY_NEW_MOTIVATION_PLAN_ID;
        $transaction->amount_usd = -$plan_price;
        $transaction->balance_usd_after_transaction = $user->balance_usd - $plan_price;
        $transaction->save();
    }

    /**
     * Присваивает пользователю купленный план
     *
     * @param User $user
     * @param int $plan_id
     */
    public function assignPurchasedPlanToUser(User $user, int $plan_id)
    {
        $user->motivation_plan_id = $plan_id;
        $user->motivation_plan_start_at = Carbon::now();
        $user->save();
    }

    /**
     * Возвращает id задачи в таблице jobs.
     *
     * @param $job
     * @return int
     */
    public function jobId($job)
    {
        return (int)app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch($job);
    }

    /**
     * Запланировать первое начисление по мотивационному плану
     *
     * @param MotivationPlan $motivation_plan
     */
    public function createAccrualTasks(MotivationPlan $motivation_plan)
    {
        $accrual_params = MotivationPlanParam::where('motivation_plan_id', $motivation_plan->id)->orderby('month_number')->get();

        foreach ($accrual_params as $accrual_params) {
            $job = (new AccrueBonusesNewMotivationSystem(
                Auth()->user(),
                $accrual_params->deposit_profit_bonus_percent,
                $accrual_params->referrals_profit_bonus_percent
            ))->allOnQueue('AccrueBonusesNewMotivationSystem')
                ->delay(now()->addMonths($accrual_params->month_number))
                /*->delay(now()->addSeconds($accrual_params->month_number))
                ->delay(now()->addMinutes($accrual_params->month_number))*/;

            // Сохраняем id пользователя, связанного с задачей начисления
            $job = Job::find($this->jobId($job));
            if (!is_null($job)) {
                $job->user_id = Auth::user()->id;
                $job->save();
            }
        }
    }

    /**
     * Покупка мотивационного плана
     *
     * @param Request $request
     * @param MotivationPlan $motivation_plan
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function buyMotivationPlan(Request $request, MotivationPlan $motivation_plan)
    {
        // Валидация
        $this->validation($request, $motivation_plan);
        // Покупка плана
        try {
            DB::beginTransaction();
            // Присваиваем пользователю купленный план
            $this->assignPurchasedPlanToUser(Auth::user(), $motivation_plan->id);
            // Создаем транзакцию покупки плана
            $this->createBuyTransaction(Auth::user(), $motivation_plan->price);
            //
            Log::channel('actionlog')->info(Auth()->user()->email . '(id=' . Auth()->user()->id . ') купил план мотивации: ' .
                $motivation_plan->name . ' за $' . $motivation_plan->price . ' Параметры плана: ' . serialize($motivation_plan->attributesToArray()));
            // Создаем задачи начисления
            $this->createAccrualTasks($motivation_plan);
            //
            DB::commit();
            $msg_type = 'flash_success';
            $msg = 'Выбранный план успешно приобретен.';
        } catch (\Exception $e) {
            DB::rollback();
            $msg_type = 'flash_danger';
            $msg = 'Ошибка приобретения плана. Обратитесь, пожалуйста, в тех. поддержку.';
            Log::error($e->getMessage());
        }

        return back()->with($msg_type, $msg);
    }

}
