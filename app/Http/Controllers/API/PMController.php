<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Consts\AlertType;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Consts\WalletsTypesConsts;
use App\Models\Home\Alert;
use App\Models\Home\Transaction;
use App\Models\Home\UserPaymentDetail;
use App\Models\Home\Wallet;
use App\Models\User;
use App\Notifications\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Telegram\Bot\Laravel\Facades\Telegram;


class PMController extends Controller
{
    public function showPaymentForm($id)
    {
        $payment = UserPaymentDetail::where('id',$id)->first();
        $data = explode('#',$payment->additional_data);
        $currency = $payment->currency->code;

        if ( $payment->address!='' ) {
            return redirect()->route('home.balance');
        }

        return view('dashboard.payment.pm_merchant', [
            'order'     => $payment->id,
            'summ'      => $data[1],
            'currency'  => $currency,
        ]);
    }

    public function getResult(Request $request)
    {
        UserPaymentDetail::where('id', $request->PAYMENT_ID)->update(['status' => 1]);

        //$input = $request->all();Log:info(json_encode($input));
        $input = $request->all();

        Log::stack(['single'])->info(print_r($input, true));

        if(!isset($input['PAYER_ACCOUNT']) || $input['PAYMENT_BATCH_NUM']==0){
            return redirect()->route('home.balance')->with('messagePayment','Ошибка при проведении платежа');
        }
        $secret = strtoupper( md5('6nHT36b49kDPKLvIegWlhKKAT') );
        $hash = $input['PAYMENT_ID'].':'.
        $input['PAYEE_ACCOUNT'].':'.
        $input['PAYMENT_AMOUNT'].':'.
        $input['PAYMENT_UNITS'].':'.
        $input['PAYMENT_BATCH_NUM'].':'.
        $input['PAYER_ACCOUNT'].':'.
        $secret.':'.
        $input['TIMESTAMPGMT'];

        $hash = strtoupper( md5($hash) );
            if ($hash == $_POST['V2_HASH'])
            {
                $id = $input['PAYMENT_ID'];
                $data = array(
                                'PAYER_ACCOUNT'         =>  $input['PAYER_ACCOUNT'],
                                'PAYEE_ACCOUNT'         =>  $input['PAYEE_ACCOUNT'],
                                'PAYMENT_AMOUNT'        =>  $input['PAYMENT_AMOUNT'],
                                'PAYMENT_UNITS'         =>  $input['PAYMENT_UNITS'],
                                'TIMESTAMPGMT'          =>  $input['TIMESTAMPGMT'],
                    );
                $mes = $this->paymentProcess($id,$data,$input['PAYMENT_AMOUNT']);
                

                return redirect()->route('home.balance')->with('messagePayment',$mes);
            }

           // ob_end_clean(); exit($input['m_orderid'].'|error');
            return redirect()->route('home.balance')->with('messagePayment','Ошибка при проведении платежа');
    }

    private function paymentProcess($id,$data,$amount)
    {
        // проверка, что запрос уже поступал и обрабатывался
        try {
            $payment = UserPaymentDetail::where('id', $id)->first();

            if ($payment->address != '') {
                return 'Ошибка при проведении платежа';
            }

            $payment->address = json_encode($data);
            $payment->save();
        } catch(\Exception $e) {
            return $e->getMessage();
        }

        DB::beginTransaction();
        try{
            $user_id = $payment->user_id;

            $wallet                 = new Wallet;
            $wallet->user_id        = $user_id;
            $wallet->currency_id    = $payment->currency_id;
            $wallet->address        = $data['PAYER_ACCOUNT'];
            $wallet->wallet_type_id = WalletsTypesConsts::INVEST_WALLET_TYPE_ID;
            $wallet->save();

            $user = User::where('id',$user_id)->first();

            $balance_usd_after_transaction              = $user->balance_usd+$amount;
            $transaction                                = new Transaction;
            $transaction->user_id                       = $user_id;
            $transaction->transaction_type_id           = TransactionsTypesConsts::INVEST_TYPE_ID;
            $transaction->wallet_id                     = $wallet->id;
            $transaction->amount_usd                    = $amount;
            $transaction->currency_id                   = $payment->currency_id;
            $transaction->balance_usd_after_transaction = $balance_usd_after_transaction;
            $transaction->currency_id                   = $payment->currency_id;
            $transaction->save();

            $alert                = new Alert;
            $alert->user_id       = $user->id;
            $alert->alert_id      = AlertType::REPLANISHMENT_ACCOUNT;
            $alert->amount        = $amount;
            $alert->currency_id   = $payment->currency_id;
            $alert->save();


            $alertParent                = new Alert;
            $alertParent->user_id       = $user->parent_id;
            $alertParent->alert_id      = AlertType::PARTNER_REPLENISHMENT;
            $alertParent->email         = $user->email;
            $alertParent->amount        = $amount;
            $alertParent->currency_id   = $payment->currency_id;
            $alertParent->save();

            $text = "<b><i>Ввод через Perfect Money.</i></b>\n"
                        . "Email: "
                        . $user->email."\n"
                        . "Платежную систему: "
                        . "<b>".$payment->currency->name."</b>\n"
                        . "Кошелек: "
                        . "<b>".$data['PAYER_ACCOUNT']."</b>\n"
                        . "Сумма: "
                        . "<b>$".$amount."</b>\n"
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
                'amount' => $amount,
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

    public function success()
    {
        ob_end_clean();
        return redirect()->route('home.balance');
    }
    public function error()
    {
        ob_end_clean();
        return redirect()->route('home.balance');
    }

}
