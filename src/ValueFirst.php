<?php

namespace SevenSpan\ValueFirst;

use Illuminate\Support\Facades\Http;
use SevenSpan\ValueFirst\Helpers\TemplateFormatter;

final class ValueFirst implements ValueFirstInterface
{
    /**
     * @param string $to
     * @param string $message
     * @param string $tag
     *
     * @return array|mixed
     */

    public function sendMessage(string $to, string $message, string $tag = "")
    {
        $response = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])
                    ->post(config('valuefirst.api_uri'), $this->getBody($to, $message, "simple", $tag));

        // Throw an exception if a client or server error occurred...
        $response->throw();

        return $response->json();
    }

    /**
     * @param string $to
     * @param string $templateId
     * @param string $data
     *
     * @return array|mixed
     */

    public function sendTemplateMessage(string $to, string $templateId, array $data, string $tag = "")
    {
        $response = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])
                    ->post(config('valuefirst.api_uri'), $this->getBody($to, $templateId, "template", $tag, $data));

        // Throw an exception if a client or server error occurred...
        $response->throw();

        return $response->json();
    }


    /**
     * @param string $to
     * @param string $message
     * @param string $mesageType
     * @param string $tag
     * @param array  $data
     *
     * @return array
     */

    protected function getBody(string $to, string $message, string $messageType, string $tag = "", array $data = [])
    {
        $body = [];
        $body['@VER'] = "1.2";

        $body['USER']['@USERNAME'] = config('valuefirst.username');
        $body['USER']['@PASSWORD'] = config('valuefirst.password');
        $body['USER']['@UNIXTIMESTAMP'] = "";

        $body['DLR']['@URL'] = "";

        $body['SMS'] = [];

        $address = [];
        array_push($address, [
            '@FROM' => config('valuefirst.from'),
            '@TO' => $to,
            '@SEQ' => "1",
            '@TAG' => $tag,
        ]);

        $sms = [
            '@UDH' => "0",
            '@CODING' => "1",
            '@PROPERTY' => "0",
            '@ID' => "1",
            'ADDRESS' => $address,
        ];

        if ($messageType == "template") {
            $sms['@TEMPLATEINFO'] = TemplateFormatter::formatTemplateData($message, $data);
        } else {
            $sms['@TEXT'] = $message;
        }
        array_push($body['SMS'], $sms);

        return $body;
    }
}
