<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Home\UserPaymentDetail;
use App\Models\Consts\WalletsTypesConsts;
use App\Services\WhitebitService;
use App\Models\Home\Wallet;
use App\Models\Consts\TransactionsTypesConsts;
use Illuminate\Support\Facades\DB;
use App\Models\Home\Transaction;
use GuzzleHttp\Client;
use App\Models\Home\Alert;
use App\Models\Consts\AlertType;
use Telegram\Bot\Laravel\Facades\Telegram;

class CoinsController extends Controller
{
    public function showPaymentForm($id)
    {
    	$payment = UserPaymentDetail::where('id',$id)->first();
    	$data = explode('#',$payment->additional_data);
    	$currency     = $payment->currency;
        $myCoinWallet = 0;
        $publicKey    = null;

        switch ( $currency->code ) {
            case 'BTC':
                $myCoinWallet = '15pbS8bFnKoaYCTtq4THCromAQdSnG6Dgd';
                break;
            case 'ETH':
                $myCoinWallet = '0xf86DD5FE3e5dbe1843382B6849Eb3a6C48A2879F';
                break;
            case 'PZM':
                $myCoinWallet = 'PRIZM-6KU9-QM68-4QYU-MBH98';
                $publicKey    = 'c79081f194504d26d7f1fae05c4dfdbb315152f0ae4b2501ab2ed2b90c3fb61a';
                break;
            case 'USDT':
                $wallet = Wallet::where('user_id', Auth()->user()->id)->first();
                if (empty($wallet)) {
                    $service = new WhitebitService();
                    $dataWhitebit = $service->createAddress();
                    $wallet = Wallet::create([
                        'user_id' => Auth()->user()->id,
                        'currency_id' => $currency->id ?? 0,
                        'address' => !empty($dataWhitebit->account) ? ($dataWhitebit->account->address ?? '') : '',
                        'wallet_type_id' => WalletsTypesConsts::INVEST_WALLET_TYPE_ID,
                    ]);
                }
                $myCoinWallet = !empty($wallet) ? $wallet['address'] : '';
                break;
        }

    	$coinInfo = $this->getCryptoCurrencyInformation($currency->name);
    	if ( $payment->address!='' ) {
    	    return redirect()->route('home.balance');
        }

    	return view('dashboard.payment.payment_coin', [
    	    'order'         => 'order_' . $payment->id,
            'summ'          => $data[1],
            'currency'      => $currency,
            'desc'          => $data[0],
            'payment_id'    => $payment->id,
            'coinInfo'      => $coinInfo,
            'myCoinWallet'  => $myCoinWallet,
            'publicKey'     => $publicKey,
        ]);
    }

    public function sendRequest(Request $request, $id){
    	$payment = UserPaymentDetail::find($id);
        $user_id = Auth()->user()->id;
        $code = $payment->currency->code;
        $codeAmount = 'amount_'.$code;

        DB::beginTransaction();
        try{
            $wallet 				= new Wallet;
            $wallet->user_id    	= $user_id;
            $wallet->currency_id 	= $request->currency_id;
            $wallet->address 	    = $request->address;
            $wallet->wallet_type_id = WalletsTypesConsts::INVEST_WALLET_TYPE_ID;
            $wallet->save();


            if ( $payment->currency->code != 'USDT') { // Временное условие, разобраться!
                $transaction                                = new Transaction;
                $transaction->user_id                       = $user_id;
                $transaction->transaction_type_id           = TransactionsTypesConsts::INVEST_COIN_REQUEST_TYPE_ID;
                $transaction->wallet_id                     = $wallet->id;
                $transaction->amount_usd                    = 0;
                $transaction->amount_crypto                 = $request->amount_crypto;
                $transaction->$codeAmount                   = $request->amount_crypto;
                $transaction->currency_id                   = $request->currency_id;
                $transaction->rate                          = $request->rate;
                $transaction->save();

                $payment->status = 1;
                $payment->transaction_id = $transaction->id;
                $payment->save();
            }

            $alert                = new Alert;
            $alert->user_id       = $user_id;
            $alert->alert_id      = AlertType::INVEST_COIN_REQUEST;
            $alert->amount        = $request->amount_crypto;
            $alert->currency_id   = $request->currency_id;
            $alert->currency_type = $code;
            $alert->save();


            /* $text = "<b><i>Заявка на ввод.</i></b>\n"
                        . "Email: "
                        . Auth()->user()->email."\n"
                        . "Платежную систему: "
                        . "<b>".$transaction->currency->name."</b>\n"
                        . "Кошелек: "
                        . "<b>".$request->address."</b>\n"
                        . "Сумма: "
                        . "<b>".$transaction->currency->code.' '.$request->amount_crypto."</b>\n"
                        . "Дата: "
                        . "<b>".$transaction->created_at."</b>\n";

            Telegram::sendMessage([
                'chat_id' => env('TELEGRAM_CHANNEL_ID', '735032395'),
                'parse_mode' => 'HTML',
                'text' => $text
            ]); */

            DB::commit();
            return redirect()->route('home.balance');
        }catch(\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    private function getCryptoCurrencyInformation($currency = 'Bitcoin'){
        $url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids='.strtolower($currency);
        $data = @file_get_contents($url);
        $priceInfo = json_decode($data);

        return !empty($priceInfo) ? $priceInfo[0] : [
            "id" => "tether",
            "image" => "https://assets.coingecko.com/coins/images/325/large/Tether.png?1668148663",
            "current_price" => 1,
        ];
    }
}
