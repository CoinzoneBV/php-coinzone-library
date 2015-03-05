<?php

class CoinzoneCallback
{
    /**
     * @var string
     */
    private $clientCode;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @return string
     */
    public function getClientCode()
    {
        return $this->clientCode;
    }

    /**
     * @param string $clientCode
     */
    public function setClientCode($clientCode)
    {
        $this->clientCode = $clientCode;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param $clientCode
     * @param $apiKey
     */
    public function __construct($clientCode, $apiKey)
    {
        $this->setClientCode($clientCode);
        $this->setApiKey($apiKey);
    }

    /**
     * @param $headers
     * @param $url
     * @param $content
     * @return bool
     */
    public function isValidCallback($headers, $url, $content)
    {
        $nHeaders = array();
        foreach ($headers as $key => $value) {
            $nHeaders[strtolower($key)] = $value;
        }

        $stringToSign = $content . $url . $nHeaders['timestamp'];
        $signature = hash_hmac('sha256', $stringToSign, $this->getApiKey());

        return $signature === $nHeaders['signature'];
    }
}
