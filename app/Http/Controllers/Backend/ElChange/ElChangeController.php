<?php

namespace App\Http\Controllers\Backend\ElChange;

use App\Models\Home\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Consts\TransactionsTypesConsts;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Response;
use App\Models\User;
use App\Models\Home\OutgoingPayments;

class ElChangeController extends Controller
{
    /**
     * Получение подтверждение от мерчанта, что средства получены
     *
     * @param Request $request
     * @param Transaction $transaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function callback(Request $request, Transaction $transaction)
    {
        Log::channel('actionlog')->error('Получили от el-change.com:' . serialize($request->all()));

        $merchant_pass = config('el-change.merchant_pass');

        $post_hash = $_POST['verificate_hash'];
        unset($_POST['verificate_hash']);

        $my_hash = "";
        foreach ($_POST AS $key_post => $one_post) if ($my_hash == "") {
            $my_hash = $one_post;
        } else $my_hash = $my_hash . "::" . $one_post;

        $my_hash = $my_hash . "::" . $merchant_pass;
        $my_hash = hash("sha256", $my_hash);

        if ($my_hash == $post_hash) {
            $outgoingPayment = OutgoingPayments::find($request->payment_num);
            // В таблице есть запись с такой исходящей оплатой
            if (!is_null($outgoingPayment)) {
                // Если подтверждение этой оплаты еще не получали
                if ($outgoingPayment->received_at == '0000-00-00 00:00:00') {
                    Log::channel('actionlog')->error("Успешно. Зачисляем payment_num.id=$request->payment_num.");
                    $transaction->user_id = $outgoingPayment->user_id;
                    $transaction->transaction_type_id = TransactionsTypesConsts::INVEST_TYPE_ID;
                    $transaction->amount_usd = $request->amount;
                    $transaction->balance_usd_after_transaction = User::find($outgoingPayment->user_id)->first()->balance_usd + $request->amount;
                    $transaction->comment = serialize($request->all());
                    $transaction->save();
                    //
                    $outgoingPayment->received_at = Carbon::now();
                    $outgoingPayment->save();
                } else {
                    Log::channel('actionlog')->error("Повторно получили подтверждение по оплате (получили " . $outgoingPayment->received_at . ") outgoing_payments.id= $request->payment_num. Игнорируем.");
                }
            } else {
                Log::channel('actionlog')->error("Получили оплату $request->payment_num, но не нашли ее в таблицуе outgoing_payments. " . serialize($request->all()));
            }
        } else Log::channel('actionlog')->error("$merchant_pass Не совпадают хэши. Проверь пароль мерчанта в лк и в .env.");

        return response()->json("ok", 202);
    }
}
