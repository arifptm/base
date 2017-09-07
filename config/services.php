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
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '207326123182-us1r64014co3njg8ou3svktsmbo0fhfg.apps.googleusercontent.com',
        'client_secret' => 'Z-WEDfNHn9i4Kb9L3FMfeKRr',
        'redirect' =>  env('APP_URL').'/login/google/callback',
    ],   

    'facebook' => [
        'client_id' => '490750767926016',
        'client_secret' => '74ef13dfac3752b8624043d4c226116e',
        'redirect' => 'http://base.test/login/facebook/callback',
    ],

];
