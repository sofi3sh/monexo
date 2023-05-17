<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Backend\RateController;
use App\Http\Controllers\Controller;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Consts\WalletsTypesConsts;
use App\Models\Home\Currency;
use App\Models\Home\Transaction;
use App\Models\Home\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Home\Ipn;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Home\UserPaymentDetail;
use App\Models\Home\Alert;
use App\Models\Consts\AlertType;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Notifications\Deposit;

class PayeerController extends Controller
{
    public function showPaymentForm($id)
    {
        $payment = UserPaymentDetail::where('id',$id)->first();
        $data = explode('#',$payment->additional_data);
        $currency = $payment->currency->code;

        if ( $payment->address != '' ) {
            return redirect()->route('home.balance');
        }

        return view('dashboard.payment.payeer_merchant', [
            'order'     => 'order_' . $payment->id,
            'summ'      => $data[1],
            'currency'  => $currency,
            'desc'      => $data[0],
        ]);
    }

    public function getResult(Request $request)
    {
        $input = $request->all();
    //   Log:info('Payeer result:'.json_encode($input));
        if (isset($input['m_operation_id']) && isset($input['m_sign']))
        {
            $m_key = 'Sedtanya18';

            $arHash = array(
                    $input['m_operation_id'],
                    $input['m_operation_ps'],
                    $input['m_operation_date'],
                    $input['m_operation_pay_date'],
                    $input['m_shop'],
                    $input['m_orderid'],
                    $input['m_amount'],
                    $input['m_curr'],
                    $input['m_desc'],
                    $input['m_status']
            );

            if (isset($input['m_params']))
            {
                    $arHash[] = $input['m_params'];
            }

            $arHash[] = $m_key;

            $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));

            if ($input['m_sign'] == $sign_hash && $input['m_status'] == 'success')
            {
                $id = explode('_', $input['m_orderid']);
                $data = array(
                                'm_operation_id'        =>  $input['m_operation_id'],
                                'm_operation_ps'        =>  $input['m_operation_ps'],
                                'm_operation_date'      =>  $input['m_operation_date'],
                                'm_operation_pay_date'  =>  $input['m_operation_pay_date'],
                                'm_amount'              =>  $input['m_amount'],
                                'm_curr'                =>  $input['m_curr'],
                    );
                $mes = $this->paymentProcess($id[1],$data,$input['m_amount']);
                return redirect()->route('home.balance')->with('messagePayment',$mes);
            }

        }
        if(isset($input['m_orderid'])){
            $id = explode('_',$input['m_orderid']);
            $this->paymentFail($id[1]);
        }
        return redirect()->route('home.balance')->with('messagePayment','Ошибка при проведении платежа');
    }

    private function paymentProcess($id,$data,$amount)
    {
        DB::beginTransaction();
        try{
            $payment = UserPaymentDetail::where('id',$id)->first();
            $user_id = $payment->user_id;

            if($payment->address !='' || $payment->address == 'cancellation of payment') return 'Ошибка при проведении платежа';

                $wallet                 = new Wallet;
                $wallet->user_id        = $user_id;
                $wallet->currency_id    = $payment->currency_id;
                $wallet->address        = $data['m_operation_id'];
                $wallet->wallet_type_id = WalletsTypesConsts::INVEST_WALLET_TYPE_ID;
                $wallet->save();

                $user = User::where('id',$user_id)->first();

                $balance_usd_after_transaction              = $user->balance_usd+$data['m_amount'];
                $transaction                                = new Transaction;
                $transaction->user_id                       = $user_id;
                $transaction->transaction_type_id           = TransactionsTypesConsts::INVEST_TYPE_ID;
                $transaction->wallet_id                     = $wallet->id;
                $transaction->amount_usd                    = $data['m_amount'];
                $transaction->currency_id                   = $payment->currency_id;
                $transaction->balance_usd_after_transaction = $balance_usd_after_transaction;
                $transaction->save();

                $payment->address = json_encode($data);
                $payment->save();

                $alert                = new Alert;
                $alert->user_id       = $user_id;
                $alert->alert_id      = AlertType::REPLANISHMENT_ACCOUNT;
                $alert->amount        = $data['m_amount'];
                $alert->currency_id   = $payment->currency_id;
                $alert->save();

                $alertParent                = new Alert;
                $alertParent->user_id       = $user->parent_id;
                $alertParent->alert_id      = AlertType::PARTNER_REPLENISHMENT;
                $alertParent->email         = $user->email;
                $alertParent->amount        = $data['m_amount'];
                $alertParent->currency_id   = $payment->currency_id;
                $alertParent->save();

                $text = "<b><i>Ввод через Payeer.</i></b>\n"
                            . "Email: "
                            . $user->email."\n"
                            . "Платежную систему: "
                            . "<b>".$payment->currency->name."</b>\n"
                            . "Кошелек: "
                            . "<b>".$data['m_operation_id']."</b>\n"
                            . "Сумма: "
                            . "<b>$".$data['m_amount']."</b>\n"
                            . "Дата: "
                            . "<b>".$transaction->created_at."</b>\n";

                Telegram::sendMessage([
                    'chat_id' => env('TELEGRAM_CHANNEL_ID', '735032395'),
                    'parse_mode' => 'HTML',
                    'text' => $text
                ]);

                $code       = $payment->currency->code;
                $codeAmount = 'amount_'.strtolower($code);

                $data = [
                    'amount' => $data['m_amount'],
                    'code'   => $code,
                    'currency_id'   => $payment->currency->id,
                ];
                $user->notify(new Deposit($data));

            DB::commit();
            return 'Успех, деньги зачисленны на баланс';
        }catch(\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
    private function paymentFail($id)
    {
        DB::beginTransaction();
        try{
            $payment = UserPaymentDetail::where('id',$id)->first();
            if($payment->address!='' || $payment->address=='cancellation of payment') return 'Ошибка при проведении платежа';
            $payment->address = 'cancellation of payment';
            $payment->save();
            DB::commit();
            return 'Успех, деньги зачисленны на баланс';
        }catch(\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
    public function success(Request $request)
    {
        $this->getResult($request);
    //    Log:info('Payeer Success:'.json_encode($reques->all()));
        return redirect()->route('home.balance');
    }
    public function error(Request $request)
    {
    //    Log:info('Payeer Error:'.json_encode($reques->all()));
        $input = $request->all();
        if(isset($input['m_orderid'])){
            $id = explode('_',$input['m_orderid']);
            $this->paymentFail($id[1]);
        }
        ob_end_clean();
        return redirect()->route('home.balance');
    }
}
