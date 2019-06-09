<?php


namespace Korba;


class XChange extends API
{

    private $secret_key;
    private $client_key;
    private $client_id;

    public function __construct($base_url, $secret_key, $client_key, $client_id, $proxy)
    {
        $headers = array(
            'Cache-Control: no-cache',
            'Content-Type: application/json'
        );
        parent::__construct($base_url, $headers, $proxy);
        $this->secret_key = $secret_key;
        $this->client_key = $client_key;
        $this->client_id = $client_id;
    }

    private function calHMAC($data) {
        $data = (gettype($data) == 'string') ? json_decode($data, true) : $data;
        $message = '';
        $i = 0;
        ksort($data);
        foreach ($data as $key => $value) {
            $message .= ($i == 0) ? "{$key}={$value}" : "&{$key}={$value}";
            $i++;
        }
        $hmac_signature = hash_hmac('sha256', $message, $this->secret_key);
        return "Authorization: HMAC {$this->client_key}:{$hmac_signature}";
    }
}
