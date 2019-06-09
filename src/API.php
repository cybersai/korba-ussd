<?php


namespace Korba;


class API
{
    /** @var string */
    private $base_url;
    /** @var array */
    private $headers;
    /** @var string  */
    private $proxy_url;
    /** @var string */
    private $proxy_auth;


    /**
     * API constructor.
     * @param string $base_url
     * @param array $headers
     * @param null|string $proxy
     */
    public function __construct($base_url, $headers, $proxy = null)
    {
        $this->base_url = $base_url;
        $this->headers = $headers;
        if ($proxy) {
            $quota_guard = parse_url($proxy);
            $this->proxy_url = "{$quota_guard['host']}:{$quota_guard['port']}";
            $this->proxy_auth = "{$quota_guard['user']}:{$quota_guard['pass']}";
        }
    }

    /**
     * @param string $end_point
     * @param string $data
     * @return bool|string
     */
    private function engine($end_point, $data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "{$this->base_url}/{$end_point}");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setOpt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        if ($this->proxy_url) {
            curl_setopt($ch, CURLOPT_PROXY, $this->proxy_url);
            curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->proxy_auth);
        }
        $result = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        return ($error) ? $error : $result;
    }

    /**
     * @param string $endpoint
     * @param string|array $data
     * @return mixed
     */
    protected function call($endpoint, $data) {
        $res = (gettype($data) == 'array') ? $this->engine($endpoint, json_encode($data)) : $this->engine($endpoint, $data);
        $result = json_decode($res, true);
        return $result;
    }
}
