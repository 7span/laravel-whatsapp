<?php

declare(strict_types=1);

namespace SevenSpan\WhatsApp;

interface WhatsAppInterface
{
    /**
     * @return array|mixed
     */
    public function sendMessage(string $WhatsAppBussnessAccountId, string $accessToken, string $to, string $templateName, string $languageCode, string $message);
}
