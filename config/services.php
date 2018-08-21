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
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],


    'spotify' => [
        'token' => "BQAJ14jlzqCj4tT5BR434SkjpYpOl62PUoyueFhK3wyea-6M3WhSoYSJJaVAcT2yusq6f8Qs8rc-cLIoieL9TnllvDJKiNXzRdX_BJIk6aDypHC_xMxRHh0J7MWNO7xPJBqmJChLAGOpNRc6GrxfiUWyN0XcaSkzGA",
        'refresh_token' => "AQDl96DldOFAew1YC6aGbv7Wa84iE26qJWC9JJZ0F5_bsYGv5ziof6RGUXh5Xx1B3ggWj0rPTRHalh9yKJ2w9WqeZlydZ3DNWwcIyY1J_C24klmw8rbKwirknpGzfjFona8",
        'id' => env('SPOTIFY_API_ID'),
        'secret' => env('SPOTIFY_API_SECRET'),
    ],

    'testconfig' => [
        "token" => "",
    ],

];
