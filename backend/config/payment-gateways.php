<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Payment Gateway Configuration
    |--------------------------------------------------------------------------
    |
    | Configure payment gateways for processing payments on the platform
    |
    */

    'gateways' => [
        'stripe' => [
            'enabled' => env('STRIPE_SECRET_KEY') !== null,
            'public_key' => env('STRIPE_PUBLIC_KEY'),
            'secret_key' => env('STRIPE_SECRET_KEY'),
            'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
            'commission_rate' => 2.9, // 2.9% + $0.30
            'fixed_fee' => 0.30,
        ],
        'paypal' => [
            'enabled' => env('PAYPAL_CLIENT_ID') !== null,
            'mode' => env('PAYPAL_MODE', 'sandbox'),
            'client_id' => env('PAYPAL_CLIENT_ID'),
            'client_secret' => env('PAYPAL_CLIENT_SECRET'),
            'commission_rate' => 2.2, // 2.2% + $0.30
            'fixed_fee' => 0.30,
        ],
        'bank_transfer' => [
            'enabled' => true,
            'requires_approval' => true,
            'commission_rate' => 0,
            'fixed_fee' => 0,
        ],
        'mobile_money' => [
            'enabled' => env('MOBILE_MONEY_ENABLED', false),
            'commission_rate' => 1.5,
            'fixed_fee' => 0,
        ],
        'crypto' => [
            'enabled' => env('CRYPTO_ENABLED', false),
            'commission_rate' => 1.0,
            'fixed_fee' => 0,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Currency Settings
    |--------------------------------------------------------------------------
    */

    'currencies' => [
        'default' => 'USD',
        'supported' => [
            'USD', 'EUR', 'GBP', 'JPY', 'AUD', 'CAD', 'CHF', 'CNY', 'INR', 'MXN'
        ],
        'exchange_rate_provider' => env('EXCHANGE_RATE_PROVIDER', 'openexchangerates'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Commission Configuration
    |--------------------------------------------------------------------------
    */

    'commission' => [
        'platform_default' => env('COMMISSION_RATE', 10.00),
        'affiliate_default' => 5.00,
        'calculation_method' => 'percentage', // percentage or fixed
        'enable_tiered_pricing' => true,
        'enable_dynamic_pricing' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Settlement Configuration
    |--------------------------------------------------------------------------
    */

    'settlement' => [
        'minimum_amount' => env('WITHDRAWAL_MINIMUM', 100.00),
        'settlement_frequency' => 'weekly', // daily, weekly, monthly
        'days_to_settle' => 7, // days after booking completion
        'hold_period_days' => 14,
        'automatic_settlement' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Refund Configuration
    |--------------------------------------------------------------------------
    */

    'refunds' => [
        'auto_approve_within_hours' => 24,
        'require_manual_approval' => false,
        'refund_to_original_method' => true,
        'refund_fee_percentage' => 0,
    ],

];
