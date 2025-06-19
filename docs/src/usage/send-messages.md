# Sending WhatsApp Messages

This guide explains how to send WhatsApp template messages using the Laravel WhatsApp package.

## Get Your WhatsApp Business Phone Numbers

Before sending messages, you may need to retrieve your WhatsApp business phone numbers:

```php
use SevenSpan\WhatsApp\Facades\WhatsApp;

// Get phone numbers associated with your account
$whatsAppBusinessAccountId = config('whatsapp.whatsapp_business_account_id');
$accessToken = config('whatsapp.access_token');

$response = WhatsApp::getPhoneNumbers($whatsAppBusinessAccountId, $accessToken);
```

This returns information about all phone numbers associated with your WhatsApp Business Account.

## Sending Template Messages

WhatsApp requires using pre-approved templates for business messaging. Here's how to send them:

### Basic Template Messages

For simple templates with text and basic dynamic parameters:

```php
use SevenSpan\WhatsApp\Facades\WhatsApp;

// Required parameters
$to = "911234567890";                 // Recipient's phone number with country code
$templateName = "hello_world";        // Your approved template name
$languageCode = "en_US";              // Template language code
$accessToken = config('whatsapp.access_token');
$fromPhoneNumberId = config('whatsapp.from_phone_number_id');

// For templates with dynamic content, separate parameters with your configured separator
// If your template is "Hello {{1}}, your order #{{2}} is ready!"
$message = "John~Order123";  // Using '~' as separator

$response = WhatsApp::sendTemplateMessage(
    $to,
    $templateName,
    $languageCode,
    $accessToken,
    $fromPhoneNumberId,
    [],     // No components for simple messages
    $message
);
```

### Advanced Template Messages with Components

For templates with media, interactive elements, or complex formatting:

```php
use SevenSpan\WhatsApp\Facades\WhatsApp;

$to = "911234567890";
$templateName = "product_notification";
$languageCode = "en_US";
$accessToken = config('whatsapp.access_token');
$fromPhoneNumberId = config('whatsapp.from_phone_number_id');

$components = [
    // Header with image
    [
        'type' => 'header',
        'parameters' => [
            [
                'type' => 'image',
                'image' => [
                    'link' => 'https://example.com/image.jpg',
                ]
            ]
        ]
    ],
    
    // Body with multiple parameter types
    [
        'type' => 'body',
        'parameters' => [
            // Text parameter
            [
                'type' => 'text',
                'text' => 'Welcome Message',
            ],
            // Currency parameter
            [
                'type' => 'currency',
                'currency' => [
                    'fallback_value' => '$100.00',
                    'code' => 'USD',
                    'amount_1000' => 100000,
                ]
            ],
            // DateTime parameter
            [
                'type' => 'date_time',
                'date_time' => [
                    'fallback_value' => 'January 1, 2024',
                ]
            ],
        ],
    ],
    
    // Interactive button
    [
        'type' => 'button',
        'sub_type' => 'quick_reply',
        'index' => '0',
        'parameters' => [
            [
                'type' => 'payload',
                'payload' => 'BUTTON_PAYLOAD',
            ],
        ],
    ]
];

$response = WhatsApp::sendTemplateMessage(
    $to,
    $templateName,
    $languageCode,
    $accessToken,
    $fromPhoneNumberId,
    $components
);
```

## Response Structure

A successful message send returns:

```php
[
    "messaging_product" => "whatsapp",
    "contacts" => [
        [
            "input" => "911234567890",
            "wa_id" => "911234567890"
        ]
    ],
    "messages" => [
        [
            "id" => "wamid.HBgMOTE3ODc4OTE4MDXSDQIAERgSOUIwQzlGREQ5NUZBQjQ1OTkzAA=="
        ]
    ]
]
```

You can store this message ID for tracking delivery status.

## Component Types

### Header Components

Headers can include one of the following types:
- **Text**: For text headers
- **Image**: For image headers
- **Video**: For video headers
- **Document**: For document headers

Example image header:
```php
[
    'type' => 'header',
    'parameters' => [
        [
            'type' => 'image',
            'image' => [
                'link' => 'https://example.com/image.jpg',
            ]
        ]
    ]
]
```

### Body Components

Body components can include:
- **Text**: Plain text
- **Currency**: Formatted currency values
- **Date_Time**: Formatted date and time
- **Phone_Number**: Formatted phone numbers

Example body with multiple components:
```php
[
    'type' => 'body',
    'parameters' => [
        [
            'type' => 'text',
            'text' => 'Customer Name',
        ],
        [
            'type' => 'text',
            'text' => 'Product Title',
        ]
    ],
]
```

### Button Components

For templates with interactive buttons:
```php
[
    'type' => 'button',
    'sub_type' => 'quick_reply',
    'index' => '0', // Button position in template
    'parameters' => [
        [
            'type' => 'payload',
            'payload' => 'BUTTON_ACTION_DATA',
        ],
    ],
]
```

## Important Notes

1. **Template or Components**: Use either `$message` (for simple templates) or `$components` (for complex templates), not both simultaneously
2. **Dynamic Content**:
   - Simple text templates: Use `$message` with your configured separator
   - Complex templates: Use `$components` array structure
3. **Template Approval**: All message templates must be pre-approved by WhatsApp
4. **Phone Number Format**: Always include country code in recipient phone numbers (e.g., "911234567890")
5. **Rate Limits**: Be aware of WhatsApp API rate limits to avoid messaging blocks
6. **Error Handling**: Always implement proper error handling for API responses

## Template Types

WhatsApp supports various template types:

1. **Transactional**: Order confirmations, shipping updates, etc.
2. **Marketing**: Promotional messages (requires explicit opt-in)
3. **OTP/Authentication**: One-time passwords and verification codes
4. **Customer Service**: Support messages and inquiries

## Error Handling

```php
try {
    $response = WhatsApp::sendTemplateMessage(/* parameters */);
    
    if (isset($response['error'])) {
        // Handle API error
        $errorMessage = $response['error']['message'] ?? 'Unknown error';
        $errorCode = $response['error']['code'] ?? null;
        
        // Log the error
        \Log::error("WhatsApp API Error: {$errorMessage} (Code: {$errorCode})");
    }
} catch (\Exception $e) {
    // Handle exceptions
    \Log::error("WhatsApp Exception: " . $e->getMessage());
}
```