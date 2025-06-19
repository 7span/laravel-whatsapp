# Configuration

Follow this guide to configure the Laravel WhatsApp package for seamless integration with your application. You'll learn how to publish the configuration file, set up essential environment variables, and customize options to connect your Laravel project with the WhatsApp Cloud API.

## Quick Setup

### 1. Publish the Configuration File

Run the following command to publish the configuration file:

```bash
php artisan vendor:publish --provider="SevenSpan\WhatsApp\Providers\WhatsAppServiceProvider" --tag="config"
```

This will create a `whatsapp.php` file in the `config` directory of your Laravel project.

### 2. Add Environment Variables

Add these keys to your `.env` file to configure the WhatsApp Cloud API integration:

```
# WhatsApp Cloud API Configuration
WHATSAPP_API_URI=https://graph.facebook.com/v14.0/
WHATSAPP_BUSINESS_ACCOUNT_ID=your_business_account_id
ACCESS_TOKEN=your_access_token
FROM_PHONE_NUMBER_ID=your_phone_number_id
SEPARATOR=~
```

## Configuration Options

All options below can be modified in the `config/whatsapp.php` file.

### `api_uri`

```php
'api_uri' => env('WHATSAPP_API_URI', 'https://graph.facebook.com/v14.0/'),
```

- **Description**: Base URL for the WhatsApp Cloud API.
- **Default**: `https://graph.facebook.com/v14.0/`
- **Tip**: Update this when Meta releases newer API versions.

### `whatsapp_business_account_id`

```php
'whatsapp_business_account_id' => env('WHATSAPP_BUSINESS_ACCOUNT_ID', ''),
```

- **Description**: Your WhatsApp Business Account ID (WABA).
- **Location**:
  - Visit Meta Business Settings
  - Navigate to: `Accounts > WhatsApp Accounts`
  - Click your account to find the ID.
- **Required**: ✅ Yes

### `access_token`

```php
'access_token' => env('ACCESS_TOKEN', ''),
```

- **Description**: Access token for authenticating API requests.
- **How to get it**:
  - Go to Meta Developer Portal
  - Select your app > WhatsApp > API Setup.
- **Required**: ✅ Yes

### `from_phone_number_id`

```php
'from_phone_number_id' => env('FROM_PHONE_NUMBER_ID', ''),
```

- **Description**: The ID of your registered WhatsApp Business phone number.
- **Where to find it**:
  - In the Meta Developer Portal: `WhatsApp > API Setup > Phone numbers`
- **Required**: ✅ Yes

### `separator`

```php
'separator' => env('SEPARATOR', '~'),
```

- **Description**: Character used to separate dynamic values in message templates.
- **Default**: `~`
- **Example**: If your template is: `Hello ~, your order #~ is ready!` You can dynamically replace the tildes with real data when sending the message.

## Template Approval Tips
- Keep content professional and clear
- Avoid promotional language in transactional templates
- Follow [WhatsApp's content policy](https://developers.facebook.com/docs/whatsapp/message-templates/guidelines)

## Additional Resources

- [WhatsApp Cloud API Documentation](https://developers.facebook.com/docs/whatsapp/cloud-api)
- [Meta Business Suite](https://business.facebook.com/)
- [Meta for Developers](https://developers.facebook.com/)