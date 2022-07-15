# Laravel WhatsApp API

It uses WhatsApp cloud API to send whatsapp messages.

## Installation

You can install the package via composer:

```bash
composer require sevenspan/laravel-whatsapp-api
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="SevenSpan\WhatsApp\Providers\WhatsAppServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
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

    'api_uri' => env('WHATSAPP_API_URI', 'https://graph.facebook.com/v14.0/')
];

```

## Usage

For create access token follow this link: [Click here](https://developers.facebook.com/docs/whatsapp/business-management-api/get-started)

``` php
use WhatsApp;

$whatsAppBussnessAccountId = "111111111111111"; // Your bussness account id (waba_id)(Required)
$accessToken = ""; // Access Token of the user (Required)


$response = WhatsApp::getPhoneNumbers(string $WhatsAppBusinessAccountId, string $accessToken)

#You will get output like this:
array:2 [
  "data" => array:1 [
    0 => array:5 [
      "verified_name" => "Vepaar Test"
      "code_verification_status" => "NOT_VERIFIED"
      "display_phone_number" => "+1 123-123-1234"
      "quality_rating" => "GREEN"
      "id" => "123456789012345"
    ]
  ]
  "paging" => array:1 [
    "cursors" => array:2 [
      "before" => "QVFIUlpVY3FxaW5PMVZAncElreTlWM0VqU0xIcUZADYTNac2ppUXpFeDEzbmNPMXVfYlZABSVJVaTZAmM0FDWWVYeEFlUW9BTHlSZAFBYbGUyZAVhXZAVBReDF1OENn"
      "after" => "QVFIUlpVY3FxaW5PMVZAncElreTlWM0VqU0xIcUZADYTNac2ppUXpFeDEzbmNPMXVfYlZABSVJVaTZAmM0FDWWVYeEFlUW9BTHlSZAFBYbGUyZAVhXZAVBReDF1OENn"
    ]
  ]
]
```

``` php
$to = "9111111111"; // Phone number with country code where we want to send message(Required)
$fromPhoneNumberId = '123456789012345' // You have to get from phone number id using getPhoneNumbers() method
$templateName = "hello_world"; // Template name of your template (Required)
$languageCode = "en_us"; // Template language code of your template (Required)
$message = 'test~message';  //if message is dyamic you have to passing a parameter order vice

$response = WhatsApp::sendMessage(string $accessToken, string $to, string $fromPhoneNumberId, string $templateName, string $languageCode, string $message)

#You will get output like this:
array:3 [
  "messaging_product" => "whatsapp"
  "contacts" => array:1 [
    0 => array:2 [
      "input" => "911234567890"
      "wa_id" => "911234567890"
    ]
  ]
  "messages" => array:1 [
    0 => array:1 [
      "id" => "wamid.HBgMOTE3ODc4OTE4MDXSDQIAERgSOUIwQzlGREQ5NUZBQjQ1OTkzAA=="
    ]
  ]
]

```

## Example
For Example your template is like this:

```
The OTP to login into app is: {{1}}
Regards{{2}}
Thank you!
```

You have to pass the $message parameter like this $message = "1234~Nikunj"

## Output of above template
```
The OTP to login into app is: 1234
Regards Nikunj
Thank you!
```

> Note : While sending a WhatsApp message with a template you should send the data in a sequence of the template dynamic value.

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Credits

- [Nikunj Gadhiya](https://github.com/nikunj320)
- [Hemratna Bhimani](https://github.com/hemratna)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
