<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Gym Platform (Website B)
    |--------------------------------------------------------------------------
    |
    | Authoritative gym registration processing lives on the gym platform.
    | This marketing site submits registrations server-to-server.
    | Never expose GYM_PLATFORM_API_KEY to the browser.
    |
    */
    'gym_platform' => [
        'url' => env('GYM_PLATFORM_URL', 'https://gymivida.com'),
        'api_key' => env('GYM_PLATFORM_API_KEY'),
        'timeout' => env('GYM_PLATFORM_TIMEOUT', 30),
    ],

];
