<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BuyPartnersMapApp;
use App\Models\BuyPartnersMapSetting;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Alert;
use App\Models\Home\Transaction;
use App\Models\Home\UserPaymentDetail;
use Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Session;

class BuyPartnersMapController extends Controller
{
    public function createApp(Request $request)
    {
        $settings = BuyPartnersMapSetting::find(1);
        $user = User::lockForUpdate()->find(Auth::user()->id);
        
        $data = $request->validate([
            'telegram' => 'required|min:2',
            'city' => 'required|min:2',
        ]);

        $currentBalance = $user->balance_usd;
        $price = $settings->price;

        if($price > $currentBalance) 
        {
            return redirect()->back()->withErrors(['Недостаточно денег на счёте']); 
        }

        $data['user_id'] = $user->id;
        $data['created_at'] = Carbon::now();
        $data['status'] = 0; 
        $data['purchase_date'] = Carbon::now(); 
        $data['price_of_sub'] = $settings->price; 
        $data['is_active'] = 1; 

        DB::beginTransaction();
        try {

            $app = BuyPartnersMapApp::create($data);
            $app->save();
            
            $user->balance_usd -= $settings->price;
            $user->save();
            
            UserPaymentDetail::insert(
                [
                    [
                        'user_id' => $user->id,
                        'currency_id' => 28,
                        'address' => 'Покупка места на карте партнеров (30 дней)',
                        'additional_data' => "buy partners map#$price#USD",
                        'created_at' => Carbon::now(),
                    ],
                ]
            );

            Alert::insert(
                [
                    [
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'amount' => $price,
                        'alert_id' => 35,
                        'add_info' => null,
                        'currency_type' => 'usd',
                        'marketing_plan_id' => null,
                        'created_at' => Carbon::now(),
                    ],
                ]
            );
            
            Transaction::insert([
                [
                    'user_id' => $user->id,
                    'transaction_type_id' => TransactionsTypesConsts::PARNETRS_MAP_PLACE,
                    'amount_usd' => $price,
                    'balance_usd_after_transaction' => $currentBalance - $price,
                    'created_at' => Carbon::now(),
                ],
            ]);

            DB::commit();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }

        Session::flash('status', __('base.dash.partners.buy-partners-map.success'));

        return redirect()->back();
    }
}
