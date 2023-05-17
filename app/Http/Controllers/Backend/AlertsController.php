<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Home\Alert;
use App\Models\Consts\AlertType;
use DB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Kalnoy\Nestedset\QueryBuilder;
use Log;
use phpDocumentor\Reflection\Types\Object_;
use Yajra\DataTables\Facades\DataTables;

class AlertsController extends Controller
{
    /**
     * Выводит шаблон оповещений.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        DB::beginTransaction();
        try {
            Alert::where([
                'user_id' => Auth::user()->id,
                'viewed' => 0,
            ])->update([
                'viewed' => 1,
            ]);
            DB::commit();
        } catch(\Exception $e)
        {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return view('dashboard.alerts');
    }

    /**
     * Исходя из типа уведомления возвращает выборку уведомлений.
     *
     * @param Request $request
     * @throws \Exception
     */
    public function getNotifications(Request $request)
    {
        $userId = Auth()->user()->id;
        $alertCategories = [
            'all'           => null,

            'balance'       => [
                AlertType::REPLANISHMENT_ACCOUNT,
                AlertType::WITHDRAWAL,
                AlertType::INVEST_COIN_REQUEST,
                AlertType::INVEST_COIN,
                AlertType::INVEST_COIN_REMOVE],

            'investments'   => [
                AlertType::OPENING_INVESTMENT,
                AlertType::ACCRUAL_OF_DAILY_INVESTMENT,
                AlertType::END_OF_INVESTMENT_ONE_DAY,
                AlertType::END_OF_INVESTMENT,
                AlertType::DEPOSIT_PROCENT,
                AlertType::ACCRUAL_OF_BONUSES,
                AlertType::MATCHING_BONUS],

            'partners'      => [
                AlertType::REGISTER_NEW_PARTNER,
                AlertType::ACCRUAL_OF_REFERRAL_PROFIT,
                AlertType::PARTNER_REPLENISHMENT],
            //'transfers' => [
            //    AlertType::MONEY_TRANSFER,
            //]
        ];

        // 'all' or 'balance' or ...
        $currentAlertCategory = $request->get('currentfilter', 'all');

        $notifications = Alert::where('user_id', $userId)
//            ->whereRaw("created_at <= '2020-11-28 23:51:00'") //  OR created_at > '2020-11-28 23:59:59'
            ->when($currentAlertCategory != 'all', function ($query) use ($currentAlertCategory, $alertCategories) {
                // [AlertType::REGISTER_NEW_PARTNER, AlertType::ACCRUAL_OF_REFERRAL_PROFIT ...]
                return $query->whereIn('alert_id',  $alertCategories[$currentAlertCategory]);
            })
            ->orderByDesc('created_at');
        
            return Datatables::of($notifications)->make(true);
    }

    public function alertsMakeViewed($id)
    {
        DB::beginTransaction();
        
        try {
            Alert::where([
                'user_id' => $id,
                'viewed' => 0
            ])->update([
                'viewed' => 1
            ]);

            DB::commit();

        } catch(Exception $e) {
            DB::rollBack();
            return [
                'error' => true,
                'content' => $e->getMessage()
            ];
        }

        $alerts = Alert::where('user_id', $id)
                    ->limit(5)
                    ->latest()
                    ->get();
        
        return [
            'error' => false,
            'alerts' => $alerts
        ];
    }
}
