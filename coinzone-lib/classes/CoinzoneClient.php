<?php

/**
 * Class CoinzoneLib
 */
class CoinzoneClient
{
    /**
     * Coinzone API url
     */
    const API_URL = 'https://api.coinzone.com/v2';

    /**
     * Coinzone Library version
     * @var string
     */
    private $version = '1.0.0';

    /**
     * Coinzone Client Code
     * @var string
     */
    private $clientCode;

    /**
     * Coinzone API Key
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $path;

    /**
     * Request to API paths association
     * @var array
     */
    private $availablePaths = array(
        'NewTransactionRequest' => '/transaction',
        'NewRefundRequest' => '/cancel_request',
        'GetTransactionRequest' => '/transaction/'
    );

    /**
     * Request to Response association
     * @var array
     */
    private $response = array(
        'NewTransactionRequest' => 'NewTransactionResponse',
        'NewRefundRequest' => 'NewRefundResponse',
        'GetTransactionRequest' => 'GetTransactionResponse'
    );

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

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
     * @return string
     */
    public function getPath()
    {
        return $this->path;
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
     * Set the path associated to the request
     * @param $request
     */
    private function setPath($request)
    {
        $this->path = $this->availablePaths[get_class($request)];
        if ($request instanceof GetTransactionRequest) {
            $this->path .= $request->getRefNo();
        }
    }

    /**
     * Set headers and sign the request
     * @param object $request
     * @return array
     */
    private function getRequestHeaders($request)
    {
        $timestamp = time();
        $payload = json_encode($request);
        if ($request instanceof GetTransactionRequest) {
            $payload = '';
        }
        $stringToSign = $payload . self::API_URL . $this->getPath() . $timestamp;
        $signature = hash_hmac('sha256', $stringToSign, $this->apiKey);

        return array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload),
            'clientCode: ' . $this->clientCode,
            'timestamp: ' . $timestamp,
            'signature: ' . $signature
        );
    }

    /**
     * Get Response entity for the request
     * @param $request
     * @param $response
     * @return object
     */
    private function getResponse($request, $response)
    {
        $responseObj = new $this->response[get_class($request)];
        foreach ($response->response as $responseParam => $responseValue) {
            $method = 'set' . ucfirst($responseParam);
            $responseObj->$method($responseValue);
        }

        return $responseObj;
    }

    /**
     * Check Request is valid
     * @param $request
     * @throws CoinzoneException
     */
    private function checkRequest($request)
    {
        switch (get_class($request)) {
            case 'NewTransactionRequest':
                if (!filter_var($request->getEmail(), FILTER_VALIDATE_EMAIL)) {
                    throw new CoinzoneException('Invalid Email');
                }
                break;
            default:
                break;
        }
    }

    /**
     * Send the request to Coinzone API
     * @param $request
     * @return object
     * @throws CoinzoneException
     */
    public function sendRequest($request)
    {
        $this->checkRequest($request);
        $this->setPath($request);
        $request->userAgent = 'coinzone-lib ' . $this->getVersion();

        $payload = json_encode($request);
        if ($request instanceof GetTransactionRequest) {
            $payload = '';
        }

        $headers = $this->getRequestHeaders($request);

        $url = self::API_URL . $this->getPath();
        $curlHandler = curl_init($url);
        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandler, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curlHandler, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER, false);

        if (!empty($payload)) {
            curl_setopt($curlHandler, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $payload);
        }

        $result = curl_exec($curlHandler);
        if ($result === false) {
            throw new CoinzoneException('There was an error sending the request');
        }
        $response = json_decode($result);
        curl_close($curlHandler);

        if ($response->status->code != 200 && $response->status->code != 201) {
            throw new CoinzoneException($response->status->message);
        }

        return $this->getResponse($request, $response);
    }

}
