<?php

declare(strict_types=1);

namespace SevenSpan\WhatsApp;

interface WhatsAppInterface
{
    /**
     * @return array|mixed
     */
    public function getPhoneNumbers(string $WhatsAppBusinessAccountId, string $accessToken);

    /**
     * @return array|mixed
     */
    public function sendMessage(string $accessToken, string $to, string $fromPhoneNumberId, string $templateName, string $languageCode, string $message);
}
