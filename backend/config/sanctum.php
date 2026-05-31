<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Sanctum Configuration
    |--------------------------------------------------------------------------
    |
    | Sanctum is a lightweight authentication package for SPAs and APIs.
    | It provides a simple yet powerful way to protect your API routes.
    |
    */

    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s',
        'localhost,localhost:3000,localhost:3001,localhost:8000,127.0.0.1,127.0.0.1:8000,127.0.0.1:3000,127.0.0.1:3001,::1',
        env('SANCTUM_STATEFUL_DOMAINS') ? ',' . env('SANCTUM_STATEFUL_DOMAINS') : ''
    ))),

    'guard' => ['web'],

    'expiration' => null,

    'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),

    'middleware' => [
        'verify_csrf_token' => App\Http\Middleware\VerifyCsrfToken::class,
        'encrypt_cookies' => App\Http\Middleware\EncryptCookies::class,
    ],

];
