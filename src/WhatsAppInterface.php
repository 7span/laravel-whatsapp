<?php

declare(strict_types=1);

namespace SevenSpan\WhatsApp;

interface WhatsAppInterface
{
    /**
     * @param string $WhatsAppBusinessAccountId
     * 
     * @param string $accessToken
     * 
     * @return array|mixed
     */
    public function getPhoneNumbers(string $WhatsAppBusinessAccountId = '', string $accessToken = '');

    /**
     * @param string $to
     * 
     * @param string $templateName
     * 
     * @param string $languageCode
     * 
     * @param string $accessToken
     * 
     * @param string $fromPhoneNumberId
     * 
     * @param array $components
     * 
     * @param string $messages
     * 
     * @return array|mixed
     */
    public function sendTemplateMessage(string $to, string $templateName, string $languageCode, string $accessToken = '', string $fromPhoneNumberId = '', array $components = [], string $messages = '');
}
