<?php

return [


    /*
    |--------------------------------------------------------------------------
    | Default Sms Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default sms provider that gets used while
    | using this caching library. This connection is used when another is
    | not explicitly specified when executing a given caching function.
    |
    */

    'default' => env('SMS_DRIVER', 'ghasedak'),

    /*
    |--------------------------------------------------------------------------
    | SMS Drivers
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the sms "service" for your application as
    | well as their drivers. You may even define multiple notification for the
    | same sms driver.
    |
    | Supported drivers: "kaveh_negar", "ghasedak"
    |
    */


    'kaveh_negar' => [
        'api_key' => env('KAVEH_NEGAR_API_KEY',''),
        'username' => env('USERNAME',''),
        'password' => env('PASSWORD',''),
    ],

    'ghasedak' => [
        'api_key' => env('GHASEDAK_API_KEY'),
        'username' => env('USERNAME',''),
        'password' => env('PASSWORD',''),
    ],
];
