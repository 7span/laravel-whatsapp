# Laravel WhatsApp API

It uses WhatsApp API to send WhatsApp messages.

## Installation

You can install the package via composer:

```bash
composer require sevenspan/laravel-whatsapp
```


## Usage

For create access token follow this link: [Click here](https://developers.facebook.com/docs/whatsapp/business-management-api/get-started)

``` php
use WhatsApp;

$to = "9111111111"; // Phone number with country code where we want to send message(Required)
$whatsAppBussnessAccountId = "111111111111111"; // Your bussness account id (waba_id)(Required)
$accessToken = ""; // Access Token of the user (Required)
$templateName = "hello_world"; // Template name of your template (Required)
$languageCode = "en_us"; // Template language code of your template (Required)
$message = 'test~message';  //if message is dyamic you have to passing a parameter order vice
```
``` php
// Without passing mobile number(It will use default registered mobile number)
$response= WhatsApp::sendMessage($WhatsAppBussnessAccountId, $accessToken, $to, $templateName, $languageCode, $message);
```

## Example
For Example your template is like this:

```
The OTP to login into app is: {{1}}
Regards{{2}}
Thank you!
```

You have to pass the $message parameter like this $message = "1234~Nikuj"

## Output of above template
```
The OTP to login into app is: 1234
Regards Nikunj
Thank you!
```

```php
// if you have multiple mobile numbers then you have to pass the from parameter
$from = "911234567890";
$response= WhatsApp::sendMessage($WhatsAppBussnessAccountId, $accessToken, $to, $templateName, $languageCode, $message, $from);

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
