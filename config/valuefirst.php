<?php

return [

     /*
    |--------------------------------------------------------------------------
    | ValueFirst Whatsapp API URI
    |--------------------------------------------------------------------------
    |
    | The ValueFirst Whatsapp Message API URI.
    |
    */

    'api_uri' => env('VALUEFIRST_API_URI',''),
     
    /*
    |--------------------------------------------------------------------------
    | From Number
    |--------------------------------------------------------------------------
    |
    | The Phone number registered with ValueFirst that your SMS will come from
    |
    */

    'from' => env('VALUEFIRST_FROM',''),

     /*
    |--------------------------------------------------------------------------
    | Username
    |--------------------------------------------------------------------------
    |
    | Your ValueFirst Username
    |
    */

    'username' =>  env('VALUEFIRST_USERNAME',''),

     /*
    |--------------------------------------------------------------------------
    | Password
    |--------------------------------------------------------------------------
    |
    | Your ValueFirst Password
    |
    */

    'password' =>  env('VALUEFIRST_PASSWORD',''),
];
