<?php


namespace Korba;


class SMS extends API
{
    protected $global_from;

    public function __construct($base_url, $username, $password, $global_from = null)
    {
        $authorization = base64_encode("{$username}:{$password}");
        $headers = [
            'Authorization: Basic '.$authorization,
            'Content-Type: application/json',
            'Accept: application/json'
        ];
        $this->global_from = $global_from == null ? 'Korba' : $global_from;
        parent::__construct($base_url, $headers);
    }

    public function send($text, $to, $from = null)
    {
        $formatter = function ($value) {
            return Util::numberIntFormat($value);
        };
        $to = gettype($to) == 'array' ? array_map($formatter, $to) : Util::numberIntFormat($to);
        $data = [
            'to' => $to,
            'text' => $text
        ];
        $data['from'] = $from == null ? $this->global_from : $from;
        return $this->call('/sms/2/text/single', $data);
    }
}
