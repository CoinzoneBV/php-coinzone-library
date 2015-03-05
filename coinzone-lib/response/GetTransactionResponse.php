<?php

/**
 * Class GetTransactionResponse
 */
class GetTransactionResponse
{
    /**
     * @var string
     */
    public $merchantReference;

    /**
     * @var string
     */
    public $refNo;

    /**
     * @var float
     */
    public $amount;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var string
     */
    public $convertedAmount;

    /**
     * @var string
     */
    public $convertedCurrency;

    /**
     * @var string
     */
    public $expirationTime;

    /**
     * @var string
     */
    public $currentTime;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $url;

    /**
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->merchantReference;
    }

    /**
     * @param string $merchantReference
     */
    public function setMerchantReference($merchantReference)
    {
        $this->merchantReference = $merchantReference;
    }

    /**
     * @return string
     */
    public function getRefNo()
    {
        return $this->refNo;
    }

    /**
     * @param string $refNo
     */
    public function setRefNo($refNo)
    {
        $this->refNo = $refNo;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getConvertedAmount()
    {
        return $this->convertedAmount;
    }

    /**
     * @param string $convertedAmount
     */
    public function setConvertedAmount($convertedAmount)
    {
        $this->convertedAmount = $convertedAmount;
    }

    /**
     * @return string
     */
    public function getConvertedCurrency()
    {
        return $this->convertedCurrency;
    }

    /**
     * @param string $convertedCurrency
     */
    public function setConvertedCurrency($convertedCurrency)
    {
        $this->convertedCurrency = $convertedCurrency;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getExpirationTime()
    {
        return $this->expirationTime;
    }

    /**
     * @param string $expirationTime
     */
    public function setExpirationTime($expirationTime)
    {
        $this->expirationTime = $expirationTime;
    }

    /**
     * @return string
     */
    public function getCurrentTime()
    {
        return $this->currentTime;
    }

    /**
     * @param string $currentTime
     */
    public function setCurrentTime($currentTime)
    {
        $this->currentTime = $currentTime;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}
