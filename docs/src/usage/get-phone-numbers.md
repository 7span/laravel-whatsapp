# Getting WhatsApp Business Phone Numbers

Before sending messages, you need to set up your WhatsApp business phone numbers. This guide explains how to retrieve and manage your WhatsApp Business phone numbers.

## Retrieving Phone Numbers

```php
use SevenSpan\WhatsApp\Facades\WhatsApp;

// Get phone numbers associated with your account
$whatsAppBusinessAccountId = config('whatsapp.whatsapp_business_account_id');
$accessToken = config('whatsapp.access_token');

$response = WhatsApp::getPhoneNumbers($whatsAppBusinessAccountId, $accessToken);
```

## Response Structure

The API will return information about all phone numbers associated with your account:

```
[
    "data" => [
        [
            "verified_name" => "Test",
            "code_verification_status" => "NOT_VERIFIED",
            "display_phone_number" => "+1 123-123-1234",
            "quality_rating" => "GREEN",
            "id" => "123456789012345"
        ]
    ],
    "paging" => [
        "cursors" => [
            "before" => "QVFIUlpVY3FxaW5ZAncElreTlWM0VqU0xIcUZADYTNac2ppUXpFeDEzbmNPMXVfYlZABSVJVaTZAmM0FDWWVYeEFlUW9BTHlSZAFBYbGUyZAVhXZAVBReDF1OENn",
            "after" => "QVFIUlpVY3FxaW5PZAncElreTlWM0VqU0xIcUZADYTNac2ppUXpFeDEzbmNPMXVfYlZABSVJVaTZAmM0FDWWVYeEFlUW9BTHlSZAFBYbGUyZAVhXZAVBReDF1OENn"
        ]
    ]
]     
```