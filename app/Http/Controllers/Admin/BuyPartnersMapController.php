<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BuyPartnersMapApp;
use App\Models\BuyPartnersMapSetting;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Alert;
use App\Models\Home\Transaction;
use App\Models\Home\UserPaymentDetail;
use Carbon\Carbon;
use DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\HtmlString;
use Session;
use Yajra\DataTables\Facades\DataTables;

class BuyPartnersMapController extends Controller
{
    public function index()
    {
        $info = BuyPartnersMapSetting::find(1);
        $apps = BuyPartnersMapApp::all();
        return view('admin.buy-partners-map.index', compact('info', 'apps'));
    }

    
    public function edit()
    {
        $info = BuyPartnersMapSetting::find(1);

        return view('admin.buy-partners-map.edit', compact('info'));
    }

    
    public function update(Request $request)
    {
        $data = $request->validate([
            'title_ru' => 'required|string|min:2|max:120',
            'title_en' => 'required|string|min:2|max:120',
            'text_info_ru' => 'required|string|min:2',
            'text_info_en' => 'required|string|min:2',
            'price' => 'required|numeric|min:0',
            'level' => 'required|integer|min:0|max:255',
        ]);

        DB::beginTransaction();
        try {
            
            $settings = BuyPartnersMapSetting::find(1);
            
            $settings->update([
                'title' => [
                    'ru' => $data['title_ru'],
                    'en' => $data['title_en'],
                ],
                'text_info' => [
                    'ru' => $data['text_info_ru'],
                    'en' => $data['text_info_en'],
                ],
                'price' => $data['price'],
                'level' => $data['level'],
            ]);

            $settings->save();

            DB::commit();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return redirect()->route('admin.partners-map.buy.index');
    }

    public function changeStatus(Request $request) 
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'status' => 'required|integer'
        ]);

        DB::beginTransaction();
        try {
            $app = BuyPartnersMapApp::find($data['id']);
            $app->status = $data['status'];
            $app->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['exeption' => $e->getMessage()]);
        }

        Session::flash('success', "Статус заявки #" . $data['id'] ." успешно обновлен");

        return redirect()->back();
    }

    public function delete(Request $request) 
    {
        $data = $request->validate([
            'id' => 'required|integer',
        ]);

        $id = $data['id'];

        BuyPartnersMapApp::find($id)->delete();
        Session::flash('success', "Заявка #$id успешно удалена");

        return redirect()->back();
    }

    public function refuse(Request $request) {
        
        $data = $request->validate([
            'id' => 'required|integer'
        ]);
        
        $app = BuyPartnersMapApp::find($data['id']);
        $appNum = $app->id;
        $price = $app->price_of_sub;
        
        DB::beginTransaction();
        try {
            $user = User::lockForUpdate()->find($app->user_id);
            $currentBalance = $user->balance_usd;
            $user->balance_usd += $price;
            
            UserPaymentDetail::insert(
                [
                    [
                        'user_id' => $user->id,
                        'currency_id' => 28, // Dinway
                        'address' => 'Возврат денег за подписку на место на карте партнеров',
                        'additional_data' => "refuse partners map#$price#USD",
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
                        'alert_id' => 36,
                        'currency_id' => null,
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
                    'transaction_type_id' => TransactionsTypesConsts::PARNETRS_MAP_REFUSE,
                    'amount_usd' => $price,
                    'balance_usd_after_transaction' => $currentBalance + $price,
                    'created_at' => Carbon::now(),
                ],
            ]);


            $app->delete();
            $user->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

        Session::flash('success', "Заявка #$appNum успешно отклонена");

        return redirect()->back();
    }

    private function getDataTableJSON($query)
    {
        return DataTables::eloquent($query)
            ->addColumn('id', function (BuyPartnersMapApp $app) {
                return $app->id;
            })
            ->addColumn('info', function (BuyPartnersMapApp $app) {
                return new HtmlString(nl2br($app->getFullInfo()));
            })
            ->addColumn('status', function (BuyPartnersMapApp $app) {
                return $app->getHumanStatus($app->status);
            })
            ->addColumn('action', function (BuyPartnersMapApp $app) {
                $changeStatus = new HtmlString("
                <div class=\"d-flex justify-content-center\">
                    <button type=\"submit\" data-app-id=\"$app->id\" onclick=\"$('#app-id').val($(this).data('app-id'))\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#changeStatusModal\">
                        Изменить статус
                    </button>
                </div> 
                ");

                if($app->status === BuyPartnersMapApp::STATUS_END_OF_SUB) {
                    return new HtmlString("
                    <div class=\"d-flex flex-column align-items-center\">
                        <button type=\"submit\" data-app-id=\"$app->id\" onclick=\"$('#app-id-delete').val($(this).data('app-id'))\" class=\"btn btn-danger mb-2\" data-toggle=\"modal\" data-target=\"#deleteAppModal\">
                            Удалить заявку
                        </button>
                        <p>Убедитесь, что партнера нет на карте</p>
                    </div> 
                    ");
                }

                if($app->status === 0) {
                    return new HtmlString("
                    <div class=\"d-flex flex-column \">
                        $changeStatus
                        <div class=\"d-flex justify-content-center mt-3\">
                            <button type=\"submit\" style=\"width: 152px\" data-app-id=\"$app->id\" onclick=\"$('#app-id-refuse').val($(this).data('app-id'))\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#refuseModal\">
                                Отказать
                            </button>
                        </div>
                    </div> 
                    <br/>
                    ");
                }

                return $changeStatus;
            })
            ->toJson();
    }

    public function dataTableAll()
    {
        $query = BuyPartnersMapApp::select('*');

        return $this->getDataTableJSON($query);
    }

    
    public function dataTableDone() 
    {
        $query = BuyPartnersMapApp::where('status', 1);

        return $this->getDataTableJSON($query);
    }

    public function dataTableNotDone() 
    {
        $query = BuyPartnersMapApp::where('status', 0);

        return $this->getDataTableJSON($query);
    }
    
    public function dataTableEndOfSub() 
    {
        $query = BuyPartnersMapApp::where('status', BuyPartnersMapApp::STATUS_END_OF_SUB);

        return $this->getDataTableJSON($query);
    }



}

