# Laravel WhatsApp API

It uses WhatsApp cloud API to send template whatsapp messages.

## Installation

You can install the package via composer:

```bash
composer require sevenspan/laravel-whatsapp
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


```

## Usage

For create access token follow this link: [Click here](https://developers.facebook.com/docs/whatsapp/business-management-api/get-started)

``` php
use WhatsApp;

$whatsAppBussnessAccountId = "111111111111111"; // Your bussness account id (waba_id)(Required)
$accessToken = ""; // Access Token of the user (Required)

$response = WhatsApp::getPhoneNumbers(string $WhatsAppBusinessAccountId = '', string $accessToken = '')

#You will get output like this:
array:2 [
  "data" => array:1 [
    0 => array:5 [
      "verified_name" => "Test"
      "code_verification_status" => "NOT_VERIFIED"
      "display_phone_number" => "+1 123-123-1234"
      "quality_rating" => "GREEN"
      "id" => "123456789012345"
    ]
  ]
  "paging" => array:1 [
    "cursors" => array:2 [
      "before" => "QVFIUlpVY3FxaW5ZAncElreTlWM0VqU0xIcUZADYTNac2ppUXpFeDEzbmNPMXVfYlZABSVJVaTZAmM0FDWWVYeEFlUW9BTHlSZAFBYbGUyZAVhXZAVBReDF1OENn"
      "after" => "QVFIUlpVY3FxaW5PZAncElreTlWM0VqU0xIcUZADYTNac2ppUXpFeDEzbmNPMXVfYlZABSVJVaTZAmM0FDWWVYeEFlUW9BTHlSZAFBYbGUyZAVhXZAVBReDF1OENn"
    ]
  ]
]
```
> Note : If you want to use to get multiple Whatsapp business account numbers for better usage then please define your number in getPhoneNumbers function otherwise set your number in the environment file


``` php
$to = "9111111111"; // Phone number with country code where we want to send message(Required).
$templateName = "hello_world"; // Template name of your template (Required).
$languageCode = "en_us"; // Template language code of your template (Required).
$fromPhoneNumberId = '123456789012345' // You have to get from phone number id using getPhoneNumbers() function.

#To send the message; use the separator character in the message with respective argument. Below is an example of how to send the text message.
$message = 'test~message';  //if message is dyamic you have to passing a parameter order vice.

The customized message should be passed to the components variable along with the object.  You can refer this link for the create components [Click here](https://developers.facebook.com/docs/whatsapp/cloud-api/guides/send-message-templates)
$components  = [
        [
            'type' => 'header',
            'parameters' => [
                [
                    'type' => 'image',
                    'image' => [
                    'link' => 'http(s)://URL',
                    ]
                ]
            ]
        ],
        [
            'type' => 'body',
            'parameters' =>[
                [
                    'type' => 'text',
                    'text' => 'TEXT_STRING',
                ],
                [
                    'type' => 'currency',
                    'currency' => [
                    'fallback_value' => 'VALUE',
                    'code' => 'USD',
                    'amount_1000' => 100,
                    ]
                ],
                [
                    'type' => 'date_time',
                    'date_time' => [
                    'fallback_value' => 'MONTH DAY, YEAR',
                    ]
                ],
            ],
        ],
        [
            'type' => 'button',
            'sub_type' => 'quick_reply',
            'index' => '0',
            'parameters' => [
                [
                    'type' => 'payload',
                    'payload' => 'PAYLOAD',
                ],
            ],
        ]
      ]
```

> NOTE : The package is expecting a single paramter (either $message or $components) at a time.


```php
$response = WhatsApp::sendTemplateMessage(string $to, string $templateName, string $languageCode,  string $fromPhoneNumberId = '', array $components = [], string $message = '')

# A successful response includes an object with an identifier prefixed with wamid.
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
