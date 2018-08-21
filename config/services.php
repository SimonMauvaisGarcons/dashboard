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
        'token' => "BQBn0ZAQd9hlRoXEYy_gQJ2Dl9XtmUVhXQx6-VqeisPw4ZuwT__hSqTv1ek9rm4Z917QHAed9UdzqJjhG4UuSbKUrI4aZD7v1LfvdWsol2yMKNfcMhrextulbN9ryziDAJbD0YJAFb3Noa-UJFyT-HcZxMijOCk79A",
        'refresh_token' => "AQDl96DldOFAew1YC6aGbv7Wa84iE26qJWC9JJZ0F5_bsYGv5ziof6RGUXh5Xx1B3ggWj0rPTRHalh9yKJ2w9WqeZlydZ3DNWwcIyY1J_C24klmw8rbKwirknpGzfjFona8",
        'id' => env('SPOTIFY_API_ID'),
        'secret' => env('SPOTIFY_API_SECRET'),
    ],

];
