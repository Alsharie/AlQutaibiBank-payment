<?php

return [
    'app_key' => env('AlQutaibiBank_APP_KEY'),
    'api_key' => env('AlQutaibiBank_API_KEY'),
    'payment_destnation' => env('AlQutaibiBank_PAYMENT_DESTNATION'),
    'url' => [
        'base' => env('AlQutaibiBank_BASE_URL', 'https://newdc.qtb-bank.com:5052'),
    ]
];
