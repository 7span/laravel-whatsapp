# Basic Template


## Before You Start

- Make sure your template is **approved** in Meta's WhatsApp Manager
- The **country code** must be included in the phone number (without + symbol)
- The number of variables you provided must exactly match the number of variables in the approved template

## Quick Example

```php
use SevenSpan\WhatsApp\Facades\WhatsApp;

// 1️⃣ Set up who will receive the message
$to = "911234567890";                // Phone number with country code (no + symbol)

// 2️⃣ Choose which template to use
$templateName = "hello_world";       // Your template name from WhatsApp Manager

// 3️⃣ Set the language
$languageCode = "en_US";             // Language code (like en_US, es_ES, etc.)

// 4️⃣ Get your WhatsApp credentials (from your .env file)
$accessToken = config('whatsapp.access_token');
$fromPhoneNumberId = config('whatsapp.from_phone_number_id');

// 5️⃣ Add your custom values
// For template: "Hello {{1}}, your order #{{2}} is ready!"
$message = "John~123";               // Values separated by ~ character

// 6️⃣ Send the message!
$response = WhatsApp::sendTemplateMessage(
    $to,
    $templateName,
    $languageCode,
    $accessToken,
    $fromPhoneNumberId,
    [],                             // Leave empty for basic templates
    $message
);
```

## How It Works

1. **Your template** (created in WhatsApp Business Manager):  
   `"Hello {{1}}, your order #{{2}} is ready!"`

2. **Your code**:  
   `$message = "John~123";`

3. **Customer receives**:  
   `"Hello John, your order #123 is ready!"`

## Common Template Examples

| Template Purpose | Template Example | Code Example |
|------------------|------------------|--------------|
| Order Update | `Your order #{{1}} has been {{2}}` | `$message = "A12345~shipped";` |
| Appointment | `Your appointment is on {{1}} at {{2}}` | `$message = "Monday~3:00 PM";` |
| Welcome | `Welcome {{1}}! Thanks for joining us.` | `$message = "Sarah";` |


> **Tip:** Test your messages with your own number before sending to customers.