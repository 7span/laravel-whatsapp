<?php

namespace SevenSpan\WhatsApp;

use Illuminate\Support\Facades\Http;

class WhatsApp implements WhatsAppInterface
{
    /**
     * @return array|mixed
     */
    public function sendMessage(string $accessToken, string $to, string $fromPhoneNumberId, string $templateName, string $languageCode, string $message)
    {
        $postInput = [
            'messaging_product' => 'whatsapp',
            'to' => $to,
            'type' => 'template',
            'template' => [
                'name' =>  $templateName,
                'language' => [
                    'code' => $languageCode,
                ],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' =>  $this->getParametersData($message)
                    ],
                ],
            ],
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post(config('whatsApp.api_uri') . $fromPhoneNumberId . '/messages', $postInput);
        $response = json_decode($response->getBody(), true);
        return $response;
    }

    /*
     * @return array|mixed
     */
    public function getPhoneNumbers(string $WhatsAppBusinessAccountId, string $accessToken)
    {
        $response = Http::get(config('whatsApp.api_uri') . $WhatsAppBusinessAccountId . '/phone_numbers?access_token=' . $accessToken);
        return json_decode($response->getBody(), true);
    }

    /**
     * @param string $message
     *
     * @return array|mixed
     */
    private function getParametersData($message)
    {
        $parameter =  explode("~", $message);
        $parameters = [];
        foreach ($parameter as $value) {
            array_push(
                $parameters,
                [
                    'type' => 'text',
                    'text' => $value
                ]
            );
        }
        return $parameters;
    }
}
