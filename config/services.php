<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('CALLBACK_URL_FACEBOOK'),
    ],

    'instagram' => [  
        'client_id' => env('INSTAGRAM_CLIENT_ID'),  
        'client_secret' => env('INSTAGRAM_CLIENT_SECRET'),  
        'redirect' => env('INSTAGRAM_REDIRECT_URI'),  
    ],

   'apple' => [
    'client_id' => env('APPLE_CLIENT_ID'),
    'client_secret' => env('APPLE_CLIENT_SECRET'),
   ],

    // 'facebook' => [
    //     'client_id' => '437309054591562', //USE FROM FACEBOOK DEVELOPER ACCOUNT
    //     'client_secret' => '0b1d33e525961e04452e943ea254722d', //USE FROM FACEBOOK DEVELOPER ACCOUNT
    //     'redirect' => 'http://localhost:8080/callback/'
    // ],

];
