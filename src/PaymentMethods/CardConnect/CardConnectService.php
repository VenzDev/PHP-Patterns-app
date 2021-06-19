<?php

namespace App\PaymentMethods\CardConnect;

class CardConnectService {
    private string $merchId;
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = 'apiKey';
        $this->site = 'site';
        $this->merchId = 'merchId';
    }

    public function capture($data)
    {
        $data['merchId'] = $this->merchId;
        return $this->request('auth', 'POST', $data);
    }

    private function request($method, $request,$data = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://$this->site.cardconnect.com/cardconnect/rest/$method");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request);

        if ($request === 'POST') {
            curl_setopt(
                    $ch,
                    CURLOPT_POSTFIELDS,
                    json_encode($data)
            );
        }

        curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                        "Authorization: Basic $this->apiKey",
                        "Content-Type: application/json"
                )
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        $result = json_decode(curl_exec($ch));

        $info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($info !== 500 && $result) {
            return $result;
        } else {
            throw new Exception("Something went wrong!");
        }
    }
}