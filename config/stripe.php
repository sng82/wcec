<?php

return [

    /*
    |--------------------------------------------------------------------------
    | StripeController Keys
    |--------------------------------------------------------------------------
    |
    | The StripeController publishable key and secret key give you access to StripeController's
    | API. The "publishable" key is typically used when interacting with
    | StripeController.js while the "secret" key accesses private API endpoints.
    |
    */

    'key' => env('STRIPE_KEY'),

    'secret' => env('STRIPE_SECRET'),


    /*
    |--------------------------------------------------------------------------
    | StripeController Webhooks
    |--------------------------------------------------------------------------
    |
    | Your StripeController webhook secret is used to prevent unauthorized requests to
    | your StripeController webhook handling controllers. The tolerance setting will
    | check the drift between the current time and the signed request's.
    |
    */

    'webhook' => [
        'secret' => env('STRIPE_WEBHOOK_SECRET'),
        'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
    ],

    /*
    |--------------------------------------------------------------------------
    | Currency
    |--------------------------------------------------------------------------
    |
    | This is the default currency that will be used when generating charges
    | from your application. Of course, you are welcome to use any of the
    | various world currencies that are currently supported via StripeController.
    |
    */

    'currency' => env('STRIPE_CURRENCY', 'gbp'),

    /*
    |--------------------------------------------------------------------------
    | Currency Locale
    |--------------------------------------------------------------------------
    |
    | This is the default locale in which your money values are formatted in
    | for display. To utilize other locales besides the default en locale
    | verify you have the "intl" PHP extension installed on the system.
    |
    */

    'currency_locale' => env('STRIPE_CURRENCY_LOCALE', 'en'),

];
