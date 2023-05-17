<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//todo Так плохо, поскольку, если в .env не задан COINPAYMENTS_IPN_URL, то config('coinpayments.ipn_url') возвращает пустую строку
//нужна обработка и запись в лог ошибки, что не задан ipn
//Аналогичная ситуауия с другими параметрами coinpayments.php
Route::post(config('coinpayments.ipn_url'), 'API\CoinpaymentsController@receiveIPN');
Route::post(config('whitebitayments.hook_url'), 'API\CoinpaymentsController@receiveWhitebitHook');

Route::get('/getRates/{token}', 'Backend\RateController@getAllRates');

Route::post('/el-change/callback', 'Backend\ElChange\ElChangeController@callback');