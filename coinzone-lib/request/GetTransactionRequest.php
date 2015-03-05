<?php

/**
 * Class GetTransactionRequest
 */
class GetTransactionRequest
{
    /**
     * @var string
     */
    public $refNo;

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


}
