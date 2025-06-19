# Advanced WhatsApp Template Messages

This guide explains how to send complex WhatsApp templates with media and interactive elements.

## Component Types

WhatsApp templates support three component sections:

| Component | Purpose | Limit |
|-----------|---------|-------|
| **Header** | Visual or title element | One per template |
| **Body** | Main message with variables | One per template |
| **Buttons** | Interactive elements | Up to 3 per template |

## Sending Templates with Components

```php
use SevenSpan\WhatsApp\Facades\WhatsApp;

$components = [
    // Header component (image, video, document, or text)
    [
        'type' => 'header',
        'parameters' => [
            [
                'type' => 'image',
                'image' => [
                    'link' => 'https://example.com/product.jpg',
                ]
            ]
        ]
    ],
    
    // Body component with variables
    [
        'type' => 'body',
        'parameters' => [
            ['type' => 'text', 'text' => 'John Doe'],
            ['type' => 'currency', 'currency' => [
                'fallback_value' => '$99.99',
                'code' => 'USD',
                'amount_1000' => 99990
            ]],
            ['type' => 'date_time', 'date_time' => [
                'fallback_value' => 'January 1, 2024'
            ]]
        ]
    ],
    
    // Button component
    [
        'type' => 'button',
        'sub_type' => 'quick_reply',
        'index' => '0',
        'parameters' => [
            ['type' => 'payload', 'payload' => 'VIEW_DETAILS']
        ]
    ]
];

// Send template message
$response = WhatsApp::sendTemplateMessage(
    $to,                   // Recipient number with country code
    $templateName,         // Pre-approved template name
    $languageCode,         // e.g., 'en_US'
    $accessToken,          // From config
    $fromPhoneNumberId,    // From config
    $components            // Components array
);
```

## Component Reference

### Header Components

#### Text Header
```php
[
    'type' => 'header',
    'parameters' => [
        ['type' => 'text', 'text' => 'Your Order Status']
    ]
]
```

#### Image Header
```php
[
    'type' => 'header',
    'parameters' => [
        ['type' => 'image', 'image' => [
            'link' => 'https://example.com/image.jpg'
        ]]
    ]
]
```

#### Video Header
```php
[
    'type' => 'header',
    'parameters' => [
        ['type' => 'video', 'video' => [
            'link' => 'https://example.com/video.mp4'
        ]]
    ]
]
```

#### Document Header
```php
[
    'type' => 'header',
    'parameters' => [
        ['type' => 'document', 'document' => [
            'link' => 'https://example.com/document.pdf',
            'filename' => 'invoice.pdf'
        ]]
    ]
]
```

### Body Parameters

#### Text Parameter
```php
[
    'type' => 'body',
    'parameters' => [
        ['type' => 'text', 'text' => 'John Doe'],
    ]
]
```

#### Currency Parameter
```php
[
    'type' => 'body',
    'parameters' => [
        ['type' => 'currency', 'currency' => [
            'fallback_value' => '$99.99',
            'code' => 'USD',
            'amount_1000' => 99990  // $99.99 (in thousandths)
        ]]
    ]
]
```

#### Date/Time Parameter
```php
[
    'type' => 'body',
    'parameters' => [
        ['type' => 'date_time', 'date_time' => [
            'fallback_value' => 'January 1, 2025'
        ]]
    ]
]
```

### Button Types

#### Quick Reply Button
```php
[
    'type' => 'button',
    'sub_type' => 'quick_reply',
    'index' => '0',  // First button position
    'parameters' => [
        ['type' => 'payload', 'payload' => 'BUTTON_ACTION']
    ]
]
```

#### URL Button
```php
[
    'type' => 'button',
    'sub_type' => 'url',
    'index' => '0',
    'parameters' => [
        ['type' => 'text', 'text' => 'https://example.com']
    ]
]
```

