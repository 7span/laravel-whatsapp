# Laravel ValueFirst

It uses ValueFirst API to send whatsapp messages.

## Installation

You can install the package via composer:

```bash
composer require sevenspan/laravel-value-first
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="SevenSpan\ValueFirst\Providers\ValueFirstServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
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
```

## Usage

For sending whatsapp text messages
``` php
use ValueFirst;

$to ='9111111111'; // Phone number with country code where we want to send message(Required)
$message ='Hello'; // Message that we want to send(Required)
$tag = 'Whatsapp Message';  //Tag if you want to assign (Optional)

// Without passing tag
$response=ValueFirst::sendMessage($to,$message);

// With passing tag
$response=ValueFirst::sendMessage($to,$message,$tag);
```

For sending whatsApp text messages using template ID


``` php
use ValueFirst;

$to ='9111111111'; // Phone number with country code where we want to send message(Required)
$templateId = "123"; //Approved template ID by ValueFirst
$data = []; // Array of data to replace template data with dynamic one
$tag = 'Whatsapp Message';  //Tag if you want to assign (Optional)



// Without passing tag
$response=ValueFirst::sendTemplateMessage($to,$templateId,$data);

// With passing tag
$response=ValueFirst::sendTemplateMessage($to,$templateId,$data,$tag);

```
> Note : While sending whatsapp message with template ID, array of data should be in sequence of template dynamic value.

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
