<?php

namespace SevenSpan\WhatsAppApi;

use Illuminate\Support\Facades\Http;

final class WhatsAppApi implements WhatsAppApiInterface
{
    /**
     * @return array|mixed
     */
    public function sendMessage(string $WhatsAppBussnessAccountId, string $accessToken, string $to, string $templateName, string $languageCode, string $message, string $from = null)
    {
        $response =  $this->getAccountNumbers($WhatsAppBussnessAccountId,  $accessToken);

        // Throw an exception if a client or server error occurred...
        if (isset($response['error'])) {
            return $response;
        }
        $fromPhoneNumberId = $response['data'][0]['id']; // First phone number

        if (!empty($from)) {
            foreach ($response['data'] as $value) {
                if (str_replace(array('+', '-', ' ', ')', '('), '', $value['display_phone_number']) == $from) {
                    $fromPhoneNumberId = $value['id'];
                }
            }
        }

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
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
        ];
        $response = Http::withHeaders($headers)->post('https://graph.facebook.com/v12.0/' . $fromPhoneNumberId . '/messages', $postInput);
        $response = json_decode($response->getBody(), true);
        return $response;
    }

    /*
     * @return array|mixed
     */
    private function getAccountNumbers($WhatsAppBussnessAccountId, $accessToken)
    {
        $response = Http::get('https://graph.facebook.com/v14.0/' . $WhatsAppBussnessAccountId . '/phone_numbers?access_token=' . $accessToken);
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
