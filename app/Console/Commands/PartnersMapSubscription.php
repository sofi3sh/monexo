<?php

namespace App\Console\Commands;

use App\Mail\NewsMail;
use App\Models\BuyPartnersMapApp;
use App\Models\BuyPartnersMapSetting;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Alert;
use App\Models\Home\Transaction;
use App\Models\Home\UserPaymentDetail;
use App\Models\MapPartners;
use App\Models\NewsSubscribe;
use App\Models\NewsSubscribesSetting;
use DB;
use Illuminate\Console\Command;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Blog\Models\Post;

class PartnersMapSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PartnersMapSubscription:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ежемесячное снятие денег за подписку на карту';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now();
        $apps = BuyPartnersMapApp::all();
        $settings = BuyPartnersMapSetting::find(1);
        $price = $settings->price;

        foreach ($apps as $app) {
            $purchaseDate = new Carbon($app->purchase_date);

            if ($purchaseDate->diff($now)->days == 30) {

                DB::beginTransaction();

                try {

                    $user = User::lockForUpdate()->find($app->user_id);
                    $app = BuyPartnersMapApp::where('user_id', $app->user_id)->first();
                    $currentBalance = $user->balance_usd;

                    if ($currentBalance >= $settings->price && $app->is_active) { // если достаточно денег на счете и юзер хочет продливать подписку

                        $user->balance_usd -= $settings->price;
                        $user->updated_at = Carbon::now();

                        $app->updated_at = Carbon::now();
                        $app->purchase_date = Carbon::now();

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

                        $user->save();
                        $app->save();
                    } else {
                        $app->status = BuyPartnersMapApp::STATUS_END_OF_SUB;
                        $app->save();
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error($e->getMessage());
                }
            }
        }
    }
}
