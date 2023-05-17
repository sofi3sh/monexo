<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Backend\RateController;
use App\Http\Controllers\Controller;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Currency;
use App\Models\Home\Transaction;
use App\Models\Home\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Home\Ipn;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Home\Alert;
use App\Models\Consts\AlertType;

class CoinpaymentsController extends Controller
{
    /**
     * Получение IPN POST-запроса
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // todo Ужасная реализация.
    public function receiveIPN(Request $request)
    {
        //todo Хорошо бы эти запросы логировать в базе
        Log::info('Request from coinpayments.net: ' . @file_get_contents('php://input'));
        $merchant_id = config('coinpayments.merchant_id');
        $secret = config('coinpayments.ipn_secret');

        //
        if (!$this->checkIsSetAndNotEmpty($_SERVER, 'HTTP_HMAC')) {
            Log::error('No HMAC signature sent');
            die();
        }

        //
        $merchant = isset($_POST['merchant']) ? $_POST['merchant'] : '';
        if (empty($merchant)) {
            Log::error('No Merchant ID passed');
            die();
        }

        //
        if ($merchant != $merchant_id) {
            Log::error('Invalid Merchant ID');
            die();
        }

        //
        $request_data = @file_get_contents('php://input');
        if ($request_data === FALSE || empty($request_data)) {
            Log::error('Error reading POST data');
            die();
        }

        //
        $hmac = hash_hmac("sha512", $request_data, $secret);
        if ($hmac != $_SERVER['HTTP_HMAC']) {
            Log::error('HMAC signature does not match');
            die();
        }

        try {
            DB::beginTransaction();
            // Если транзакции с полученным ipn_id нет - создаем.
            $ipn = Ipn::firstOrNew(['ipn_id' => $request->ipn_id], $request->all());
            // todo Как-то это не очень мне нравится
            // Если у записи не заполнено поле request_data - значит, запись только что была создана, а не существующая
            if (is_null($ipn->request_data)) {
                $ipn->request_data = json_encode($request->all());
                // По address и dest_tag определяем id кошелька
                $currency = Currency::where('code', $ipn->currency)->first();
                $currency_id = is_null($currency) ? null : $currency->id;
                // Определяем id кошелька на который был выполнен платеж
                $wallet = Wallet::where('currency_id', $currency_id)
                    ->where('address', $ipn->address)
                    ->where('additional_data', $ipn->dest_tag)->first();
                $wallet_id = is_null($wallet) ? null : $wallet->id;
                $ipn->wallet_id = $wallet_id;
                $ipn->save();

                $user_id = is_null($wallet) ? null : $wallet->user_id;
                // Если в полученном IPN статус операции 100 (получены средства) И по кошельку нашли пользователя -
                // создаем транзакцию в transactions
                if (($ipn->status == 100) && !is_null($user_id)) {
                    $rate_controller = new RateController();
                    $rate = $rate_controller->getRates($currency_id);
                    $amount_usd = $request->amount * $rate;

                    $user = User::find($user_id);

                    // Создаем транзакцию
                    $transaction = Transaction::create([
                        'user_id'                       => $user_id,
                        'transaction_type_id'           => TransactionsTypesConsts::INVEST_TYPE_ID,
                        'wallet_id'                     => $wallet_id,
                        'amount_crypto'                 => $request->amount,
                        'amount_usd'                    => $amount_usd,
                        'rate'                          => $rate,
                        'end_period'                    => Carbon::now()->addDays(config('finance.contract_duration_with_traders')),
                        'balance_usd_after_transaction' => $user->balance_usd + $amount_usd,
                    ]);
                    Log::info('Created a transaction: ' . $transaction->toJson());
                }
            } else Log::info('Repeat request from coinpayments.net: ' . json_encode($request->all()));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            // todo Важно! Сделать логировани
            // dd($e->getMessage());
            // todo todo Важно! Передавать ошибку для flash-сообщения
            die();
        }

        return $this->giveSuccessResponse(200, null);
    }

    /**
     * Возвращает false когда ключ $key не задан или не существует в массиве $arr
     *
     * @param array $arr
     * @param string $key
     * @return bool
     */
    private function checkIsSetAndNotEmpty(array $arr, string $key)
    {
        return (isset($arr[$key]) || !empty($arr[$key]));
    }

    private function giveSuccessResponse(int $code, $data)
    {
        return response()->json(['status' => $code, 'response' => $data]);
    }

    public function receiveWhitebitHook(Request $request)
    {
        Log::info('Request from Whitebit.com: ' . @file_get_contents('php://input'));
        $dataRequest = json_decode(@file_get_contents('php://input'), true);
        $params      = !empty($dataRequest['params']) ? $dataRequest['params'] : [];
        //$currency  = Currency::where('code', !empty($params) ? $params['ticker'] : null)->first();
        $currency  = Currency::where('code', 'USDT')->first();
        $wallet    = Wallet::where('currency_id', (!empty($currency) ? $currency->id : null))
            ->where('address', !empty($params) ? $params['address'] : null)->first();
        $user_id   = empty($wallet) ? null : $wallet->user_id;
        $wallet_id = is_null($wallet) ? null : $wallet->id;

        if (!empty($user_id)) {
            switch ($dataRequest['method']) {
                case "deposit.processed":
                    $user = User::find($user_id);

                    // Создаем транзакцию
                    $transaction = Transaction::create([
                        'user_id'                       => $user_id,
                        'transaction_type_id'           => TransactionsTypesConsts::INVEST_TYPE_ID,
                        'wallet_id'                     => $wallet_id,
                        'amount_crypto'                 => $params['amount'] ?? 0,
                        'amount_usd'                    => $params['amount'] ?? 0,
                        'rate'                          => 1,
                        'end_period'                    => Carbon::now()->addDays(config('finance.contract_duration_with_traders')),
                        'balance_usd_after_transaction' => $user->balance_usd + ($params['amount'] ?? 0),
                    ]);
                    $user = User::where('id', '=', $user_id)->update([
                        'balance_usd' => $user->balance_usd + ($params['amount'] ?? 0),
                    ]);
                    $alert                = new Alert;
                    $alert->user_id       = $user_id;
                    $alert->alert_id      = AlertType::INVEST_COIN;
                    $alert->amount        = $params['amount'];
                    $alert->currency_id   = $currency->id;
                    $alert->currency_type = 'USDT';
                    $alert->save();

                    Log::info('Created a transaction: ' . $transaction->toJson());
                    break;
                case "withdraw.successful":
                    $user = User::where('id', '=', $user_id)->update([
                        'balance_usd' => $user->balance_usd + ($params['amount'] ?? 0),
                    ]);
                    /* Withdraw::orderBy('id','desc')
                        ->take(1)->update([
                            'status' => Withdraw::STATUS_CONFIRM,
                        ]);*/
                    break;
                case "withdraw.canceled":
                    /*Withdraw::orderBy('id','desc')
                        ->take(1)->update([
                            'status' => Withdraw::STATUS_CANCELED,
                        ]);*/
                    break;
            }
        } else Log::info('Repeat request from coinpayments.net: ' . json_encode($request->all()));


        return response()->json('success');
    }
}
