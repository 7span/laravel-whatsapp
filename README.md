# Laravel WhatsAppApi

It uses WhatsAppApi API to send whatsapp messages.

## Installation

You can install the package via composer:

```bash
composer require sevenspan/laravel-whatsapp-api
```


## Usage

For sending whatsapp text messages
``` php
use WhatsAppApi;

$to ='9111111111'; // Phone number with country code where we want to send message(Required)
$message ='Hello'; // Message that we want to send(Required)

// With passing tag
$response=WhatsAppApi::sendMessage($to,$message,$tag);
```

For sending whatsApp text messages using template ID

For create accesstoken follow this link: (https://developers.facebook.com/docs/whatsapp/business-management-api/get-started)

``` php
use WhatsAppApi;

$to ='9111111111'; // Phone number with country code where we want to send message(Required)
$WhatsAppBussnessAccountId = "111111111111111"; // Your bussness account id (waba_id)(Required)
$accessToken = ""; // AccessToken of your user (Required)
$templateName = "hello_world"; // Template name of your template (Required)
$languageCode = "en_us"; // Template language code of your template (Required)
$message = 'test~message';  //if message is dyamic you have to passing a parameter order vice
```

## Example
your template is like this:

```bash
The OTP to login into app is: {{1}}
Regards{{2}}
Thank you!
```

you have to pass the $message parameter like this:
$message = "1234~Nikuj"
her {{1}} is point to test and {{2}} is point to message

## Output of above example
``` bash
The OTP to login into app is: 1234
Regards Nikunj
Thank you!
```

```php
// Without passing from mobile number
$response= WhatsAppApi::sendMessage($WhatsAppBussnessAccountId, $accessToken, $to, $templateName, $languageCode, $message);

// if you have multiple mobile numbers then you have to pass the from parameter
$form = "911234567890"
$response= WhatsAppApi::sendMessage($WhatsAppBussnessAccountId, $accessToken, $to, $templateName, $languageCode, $message, $form);

```
> Note : While sending whatsapp message with template array of data should be in sequence of template dynamic value.

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Credits

- [Hemratna Bhimani](https://github.com/hemratna)
- [Urvashi Thakar](https://github.com/UrvashiThakar)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
