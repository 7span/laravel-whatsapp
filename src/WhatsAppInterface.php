<?php

declare(strict_types=1);

namespace SevenSpan\WhatsApp;

interface WhatsAppInterface
{
    /**
     * @return array|mixed
     */
    public function getPhoneNumbers(string $WhatsAppBusinessAccountId = '', string $accessToken = '');

    /**
     * @return array|mixed
     */
    public function sendTemplateMessage(string $to, string $templateName, string $languageCode,  string $fromPhoneNumberId = '', array $components = [], string $messages = '');

    /**
     * @param string $whatsAppBusinessAccountId
     * 
     * @param string $accessToken
     * 
     * @param array $filters
     *  
     * @return array|mixed
     */
    public function getMessageTemplates(string $accessToken, string $whatsAppBusinessAccountId, $filters = []);
}
