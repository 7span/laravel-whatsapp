<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Whatsapp API URI
    |--------------------------------------------------------------------------
    |
    | The Whatsapp Message API URI.
    |
    */

    'api_uri' => env('WHATSAPP_API_URI', 'https://graph.facebook.com/v14.0/'),

    /*
    |--------------------------------------------------------------------------
    | WHATSAPP BUSINESS ACCOUNT ID
    |--------------------------------------------------------------------------
    |
    | The Whatsapp business account id (waba_id).
    |
    */

    'whats_app_business_account_id' => env('WHATSAPP_BUSINESS_ACCOUNT_ID', ''),

    /*
    |--------------------------------------------------------------------------
    | ACCESS TOKEN
    |--------------------------------------------------------------------------
    |
    | The Whatsapp business account user access token.
    |
    */
    'access_token' => env('ACCESS_TOKEN', ''),

    /*
    |--------------------------------------------------------------------------
    | SEPARATOR
    |--------------------------------------------------------------------------
    |
    | The Whatsapp separator is used for the separat $message.
    | Note: The "separator" parameter cannot be an empty if you pass ther $message parameter.
    |
    */
    'separator' => env('SEPARATOR', '~'),

    /*
    |--------------------------------------------------------------------------
    | FROM PHONE NUMBER ID
    |--------------------------------------------------------------------------
    |
    | The Whatsapp register phome number Id.
    |
    */
    'from_phone_number_id' => env('FROM_PHONE_NUMBER_ID', ''),

];
