<?php

return [
    // The coinpayments merchant ID
    //'merchant_id' => env('COINPAYMENTS_MERCHANT_ID'),

    // Your API public key associated with your coinpayments account
    'public_key'  => env('WHITEBIT_API_KEY'),

    // Your API private key associated with your coinpayments account
    'private_key' => env('WHITEBIT_API_SECRET'),

	// URI IPN, который вызывается при приеме платежей. Часть, которая идет после префикса всех API-маршрутов (по-умолчанию /api).
	// Т.е. по-умолчанию IPN в coinpayments.net убдет http_//имя_домена/api/whitebitHook
    'hook_url'     => env('WHITEBIT_HOOK_URL', '/whitebitHook'),

    // The format of response to return, json or xml. (default: json)
    //'format'      => env('COINPAYMENTS_API_FORMAT', 'json'),
];
