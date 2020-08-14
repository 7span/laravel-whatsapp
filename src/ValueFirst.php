<?php

namespace SevenSpan\ValueFirst;

use Illuminate\Support\Facades\Http;

final class ValueFirst implements ValueFirstInterface
{
    /**
     * @param string $to
     * @param string $message
     * @param string $tag
     *
     * @return array|mixed
     */

    public function sendMessage(string $to,string $message,string $tag = "") 
    {
        $response = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json'
                    ])
                    ->post(config('valuefirst.api_uri'),$this->getBody($to,$message,$tag));

        // Throw an exception if a client or server error occurred...
        $response->throw();

        return $response->json();
    }

    /**
     * @param string $to
     * @param string $message
     * @param string $tag
     *
     * @return array
     */

    protected function getBody(string $to,string $message,string $tag = "")
    {
        $body = [];
        $body['@VER'] = "1.2";

        $body['USER']['@USERNAME'] = config('valuefirst.username');
        $body['USER']['@PASSWORD'] = config('valuefirst.password');
        $body['USER']['@UNIXTIMESTAMP'] = "";

        $body['DLR']['@URL'] = "";

        $body['SMS'] = [];
        $address = [];

        $addressData = [
            '@FROM' => config('valuefirst.from'),
            '@TO'  => $to,
            '@SEQ' => "1",
            '@TAG' => $tag
        ];
        array_push($address,$addressData);

        $sms = [
            '@UDH'      => "0",
            '@CODING'   => "1",
            '@TEXT'     => $message,
            '@PROPERTY' => "0",
            '@ID'       => "1",
            'ADDRESS'   => $address
        ];
        array_push($body['SMS'],$sms);

        return $body;
    }

}
