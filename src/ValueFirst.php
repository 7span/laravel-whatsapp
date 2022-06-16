<?php

declare(strict_types=1);

/*
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SevenSpan\ValueFirst;

use Illuminate\Support\Facades\Http;
use SevenSpan\ValueFirst\Helpers\TemplateFormatter;

final class ValueFirst implements ValueFirstInterface
{
    /**
     * @return array|mixed
     */
    public function sendMessage(string $to, string $message, string $tag = '')
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])
            ->post(config('valuefirst.api_uri'), $this->getBody($to, $message, 'simple', $tag))
        ;

        // Throw an exception if a client or server error occurred...
        $response->throw();

        return $response->json();
    }

    /**
     * @param string $data
     *
     * @return array|mixed
     */
    public function sendTemplateMessage(string $to, string $templateId, array $data, string $tag = '')
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])
            ->post(config('valuefirst.api_uri'), $this->getBody($to, $templateId, 'template', $tag, $data))
        ;

        // Throw an exception if a client or server error occurred...
        $response->throw();

        return $response->json();
    }

    /**
     * @param string $data
     *
     * @return array|mixed
     */
    public function sendTemplateMessageWithButton(string $to, string $templateId, array $data, string $tag = '', string $urlParam = '')
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])
            ->post(config('valuefirst.api_uri'), $this->getBody($to, $templateId, 'templateWithButton', $tag, $data, $urlParam))
        ;

        // Throw an exception if a client or server error occurred...
        $response->throw();

        return $response->json();
    }

    /**
     * @param string $mesageType
     *
     * @return array
     */
    private function getBody(string $to, string $message, string $messageType, string $tag = '', array $data = [], string $urlParam = null)
    {
        $body = [];
        $body['@VER'] = '1.2';

        $body['USER']['@USERNAME'] = config('valuefirst.username');
        $body['USER']['@PASSWORD'] = config('valuefirst.password');
        $body['USER']['@UNIXTIMESTAMP'] = '';

        $body['DLR']['@URL'] = '';

        $body['SMS'] = [];

        $address = [];
        array_push($address, [
            '@FROM' => config('valuefirst.from'),
            '@TO' => $to,
            '@SEQ' => '1',
            '@TAG' => $tag,
        ]);

        $sms = [
            '@UDH' => '0',
            '@CODING' => '1',
            '@PROPERTY' => '0',
            '@ID' => '1',
            'ADDRESS' => $address,
        ];

        switch ($messageType) {
            case 'template':
                $sms['@TEMPLATEINFO'] = TemplateFormatter::formatTemplateData($message, $data);

                break;

            case 'templateWithButton':
                $body['USER']['@CH_TYPE'] = '4';
                $sms['@MSGTYPE'] = '3';
                $sms['@B_URLINFO'] = $urlParam;
                $sms['@TEMPLATEINFO'] = TemplateFormatter::formatTemplateData($message, $data);

                break;

            default:
                $sms['@TEXT'] = $message;

                break;
        }
        $body['SMS'][] = $sms;

        return $body;
    }
}
