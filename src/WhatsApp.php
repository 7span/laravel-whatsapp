<?php

namespace SevenSpan\WhatsApp;

use Illuminate\Support\Facades\Http;
use SevenSpan\WhatsApp\Exceptions\CustomException;
use SevenSpan\WhatsApp\Exceptions\InvalidArgumentException;

class WhatsApp implements WhatsAppInterface
{
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
    public function sendTemplateMessage(string $to, string $templateName, string $languageCode, string $accessToken = '', string $fromPhoneNumberId = '', array $components = [], string $messages = '')
    {
        if (empty($fromPhoneNumberId)) $fromPhoneNumberId = config('whatsApp.from_phone_number_id');
        if (empty($accessToken)) $accessToken = config('whatsApp.access_token');

        if (empty($accessToken)) {
            throw new CustomException('Access token not found.');
        }

        if (empty($fromPhoneNumberId)) {
            throw new CustomException('From Phone Number Id not found.');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post(config('whatsApp.api_uri') . $fromPhoneNumberId . '/messages', $this->createBody($to, $templateName, $languageCode, $components, $messages));

        return $response->json();
    }

    /**
     * @param string $WhatsAppBusinessAccountId
     *
     * @param string $accessToken
     *
     * @return array|mixed
     */
    public function getPhoneNumbers(string $WhatsAppBusinessAccountId = '', string $accessToken = '')
    {
        if (empty($WhatsAppBusinessAccountId)) $WhatsAppBusinessAccountId = config('whatsApp.whatsapp_business_account_id');
        if (empty($accessToken)) $accessToken = config('whatsApp.access_token');

        if (empty($accessToken)) {
            throw new CustomException('Access token not found.');
        }

        if (empty($WhatsAppBusinessAccountId)) {
            throw new CustomException('WhatsApp Business Account Id not found.');
        }

        $response = Http::get(config('whatsApp.api_uri') . $WhatsAppBusinessAccountId . '/phone_numbers?access_token=' . $accessToken);
        $error = !empty(json_decode($response->getBody())->error) ? json_decode($response->getBody())->error : '';

        if (!empty($error)) {
            throw new InvalidArgumentException($error->message);
        }

        return $response->json();
    }

    /**
     * @param string $message
     *
     * @return array|mixed
     */
    private function formateParametersData($messages)
    {
        if (empty($messages)) {
            return [];
        }

        $messages =  explode(config('whatsApp.separator'), $messages);
        $parameters = [];
        foreach ($messages as $message) {
            array_push(
                $parameters,
                [
                    'type' => 'text',
                    'text' => $message
                ]
            );
        }
        return $parameters;
    }

    /**
     *
     * @param string $to
     * 
     * @param string $templateName
     * 
     * @param string $languageCode
     * 
     * @param array $components
     * 
     * @param string $messages
     * 
     * @return array|mixed
     */
    public function createBody($to, $templateName, $languageCode, $components = [], $messages = '')
    {
        $body = [
            'messaging_product' => 'whatsapp',
            'to' => $to,
            'type' => 'template',
            'template' => [
                'name' =>  $templateName,
                'language' => [
                    'code' => $languageCode,
                ],
                "components" => [],
            ],
        ];

        if (!empty($components)) {
            array_push($body['template']['components'], $components);
        } else {
            array_push(
                $body['template']['components'],
                [
                    'type' => 'body',
                    'parameters' =>  $this->formateParametersData($messages)
                ]
            );
        }

        return $body;
    }
}
