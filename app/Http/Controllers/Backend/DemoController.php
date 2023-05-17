<?php

namespace App\Http\Controllers\Backend;

use App\Models\Consts\BalanceTypeConstants;
use App\Models\Home\Balance;
use App\Models\Home\Transaction;
use App\Models\Home\UserMarketingPlan;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DemoMode\EnablingDemoModeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Param;

class DemoController extends Controller
{
    // Включить демо-режим
    public function onOff(EnablingDemoModeRequest $request)
    {
        DB::beginTransaction();
        try {
        if (Auth::user()->demo_mode) { // Выключаем демо-режим
            Auth::user()->demo_mode = false;
            // Удаляем маркетинг-план пользователя (он может быть только один)
            UserMarketingPlan::where('user_id', Auth::user()->id)->forceDelete();
            // Обнуляем балансы и удаляем транзакции
            Auth::user()->balance_usd = 0;
            Auth::user()->invested_usd_to_marketplace = 0;
            Auth::user()->profit_usd = 0;
            Auth::user()->referrals_usd = 0;
            Auth::user()->save();
            //
            $balance = Balance::where('user_id', Auth::user()->id)
                ->where('balance_type_id', BalanceTypeConstants::INVEST_TO_COIN)
                ->first();
            if (!is_null($balance)) {
                $balance->balance = 0;
                $balance->save();
            }
            $balance = Balance::where('user_id', Auth::user()->id)
                ->where('balance_type_id', BalanceTypeConstants::MAIN)
                ->first();
            if (!is_null($balance)) {
                $balance->balance = 0;
                $balance->save();
            }
            // Удаляем все транзакции
            Transaction::where('user_id', Auth::user()->id)->forceDelete();

            // Удаляем всех потомков
            $this->deleteDescendants(Auth::user());

            $msg =  trans('cabinet_home.demo_block.msg_off');
            Log::channel('actionlog')->info(Auth()->user()->email . '(id=' . Auth()->user()->id . ') выключил демо-режим.');
        } else { // Переводим в демо-режим
            Auth::user()->demo_mode = true;
            // Задаем баланс пользователю
            Auth::user()->balance_usd = random_int(Param::where('name', 'min_demo_balance')->first()->value, Param::where('name', 'max_demo_balance')->first()->value);
            Auth::user()->save();
            $msg =  trans('cabinet_home.demo_block.msg_on');
            Log::channel('actionlog')->info(Auth()->user()->email . '(id=' . Auth()->user()->id . ') включил демо-режим.');
        }
        DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('actionlog')->error('Ошибка включения/выключения демо-режима пользователем user_id=' . Auth::user()->id .
                ' ' . $e->getMessage() . ' ' . serialize($request->except('_token')));
            return back()->with(['flash_danger' =>  trans('cabinet_home.demo_block.msg_error')]);
        }

        return back()->with('flash_success', $msg);
    }

    /**
     * Удаляет всех потомков пользователя $user и их транзакции
     *
     * @param $user
     */
    public function deleteDescendants($user)
    {
        // Получаем всех потомков
        $descendants = $user->getAllLevelsDescendants(99999);
        foreach ($descendants as $descendant) {
            // На всякий случай еще раз проверяем, что это демо-пользователь
            if ($descendant->demo) {
                // Удаляем все транзакции пользователя
                Transaction::where('user_id', $descendant->id)->forceDelete();
                // Удаляем маркетинг-план пользователя
                UserMarketingPlan::where('user_id', $descendant->id)->forceDelete();
                // Записи балансов
                Balance::where('user_id', $descendant->id)->forceDelete();
            }
        }

        // Берем потомков первого уровня
        $descendants = $user->getAllLevelsDescendants(1);
        foreach ($descendants as $descendant) {
            // На всякий случай еще раз проверяем, что это демо-пользователь
            if ($descendant->demo) {
                // Удаляем пользователя и всех его потомков
                $descendant->forceDelete();
            }
        }
    }

}
