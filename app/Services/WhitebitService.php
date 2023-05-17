<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Purse;

class WhitebitService
{
    /**
     * Whitebit public key
     *
     * @var string
     */
    private $apiKey = '';

    /**
     * Whitebit secret key
     *
     * @var string
     */
    private $apiSecret = '';

    /**
     * Whitebit request path
     *
     * @var string
     */
    private $request  = '';

    /**
     * domain without last slash
     *
     * @var string
     */
    private $baseUrl  = 'https://whitebit.com';

    /**
     * boolean, enable nonce validation in time range of current time +/- 5s, also check if nonce value is unique
     *
     * @var string
     */
    private $nonceWindow  = true;

    /*
     * construct function
     */
    public function __construct()
    {
        $this->apiKey = config('whitebitayments.public_key');
        $this->apiSecret = config('whitebitayments.private_key');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function request($data)
    {
        //preparing request URL
        $completeUrl = $this->baseUrl . $this->request;
        $dataJsonStr = json_encode($data, JSON_UNESCAPED_SLASHES);
        $payload = base64_encode($dataJsonStr);
        $signature = hash_hmac('sha512', $payload, $this->apiSecret);

        //preparing headers
        $headers = [
            'Content-type: application/json',
            'X-TXC-APIKEY:' . $this->apiKey,
            'X-TXC-PAYLOAD:' . $payload,
            'X-TXC-SIGNATURE:' . $signature
        ];

        $connect = curl_init($completeUrl);
        curl_setopt($connect, CURLOPT_POSTFIELDS, $dataJsonStr);
        curl_setopt($connect, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($connect, CURLOPT_RETURNTRANSFER, true);

        $apiResponse = curl_exec($connect);
        curl_close($connect);

        //receiving data
        $jsonArrayResponse = json_decode($apiResponse);
Log::info('************ jsonArrayResponse: ' . json_encode($jsonArrayResponse));

        return $jsonArrayResponse;
    }

    /**
     * withdraw request.
     *
     * @param float $amount
     * @param string $amount
     * @return mixed
     */
    public function withdraw($amount, string $address, $paymentType)
    {
        $nonce = (string) (int) (microtime(true) * 1000); //nonce is a number that is always higher than the previous request number
        $this->request = '/api/v4/main-account/withdraw';

        $data = [
            'ticker' => 'USDT', //for example for obtaining trading balance for BTC currency
            "network" => "TRC20",
            'amount' => (string) $amount,
            "address" => $address, //"0x0964A6B8F794A4B8d61b62652dB27ddC9844FB4c",  // withdraw address
            "uniqueId" => base_convert(intval(microtime(true) * 10000), 10, 24) . base_convert(intval(rand(10000, 99999)), 10, 24),
            "request" => $this->request,
            'nonce' => $nonce,
        ];

        return $this->request($data);
    }

    /**
     * uniqueId request.
     *
     * @param float $amount
     * @return mixed
     */
    public function deposit($amount, $paymentType)
    {
    }

    /**
     * deposit url request.
     *
     * @param float $amount
     * @return mixed
     */
    public function depositURL($amount, $paymentType)
    {
        $Purse = Purse::where('user_id', '=', Auth::user()->id)->first();
        if (empty($Purse) || empty($Purse['wallet'])) {
            $data = $this->createAddress();
            Purse::where('user_id', '=', Auth::user()->id)->update([
                'walletID' => !empty($data->account) ? ($data->account->memo ?? '') : '',
                'wallet' => !empty($data->account) ? ($data->account->address ?? '') : '',
            ]);
        }

        $nonce = (string) (int) (microtime(true) * 1000); //nonce is a number that is always higher than the previous request number
        $this->request = '/api/v4/main-account/fiat-deposit-url';

        $data = [
            'ticker' => 'USDT', //for example for obtaining trading balance for BTC currency
            "network" => "TRC20",
            "uniqueId" => base_convert(intval(microtime(true) * 10000), 10, 24) . base_convert(intval(rand(10000, 99999)), 10, 24),
            "amount" => $amount,
            "request" => $this->request,
            'nonce' => $nonce,
        ];

        $responce = $this->request($data);
        return $responce->url ?? '';
    }

    /**
     * create address request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function createAddress()
    {
        $nonce = (string) (int) (microtime(true) * 1000); //nonce is a number that is always higher than the previous request number
        $this->request = '/api/v4/main-account/create-new-address';

        $data = [
            'ticker' => 'USDT', //for example for obtaining trading balance for BTC currency
            "network" => "TRC20",
            "request" => $this->request,
            'nonce' => $nonce,
        ];

        return $this->request($data);
    }
}
