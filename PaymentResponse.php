<?php
/**
 * Created by PhpStorm.
 * User: vasiliy
 * Date: 04/10/2016
 * Time: 12:57 ΜΜ
 */

namespace TwoDudes\FXPay;


/**
 * Class VendorResponse
 * @package TwoDudes\FXPay
 */
/**
 * Class PaymentResponse
 * @package TwoDudes\FXPay
 */
class PaymentResponse
{
    /**
     * @var
     */
    protected $amount;

    /**
     * @var
     */
    protected $currency;

    /**
     * @var
     */
    protected $wallet;

    /**
     * @var
     */
    protected $handler;

    /**
     * @var array
     */
    protected $vendorParams = array();


    /**
     * @var
     */
    protected $netAmount;

    /**
     * @var
     */
    protected $commission;

    /**
     * @var
     */
    protected $requestId;

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getWallet()
    {
        return $this->wallet;
    }

    /**
     * @param mixed $wallet
     */
    public function setWallet($wallet)
    {
        $this->wallet = $wallet;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param mixed $handler
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return array
     */
    public function getVendorParams(): array
    {
        return $this->vendorParams;
    }

    /**
     * @param array $vendorParams
     */
    public function setVendorParams(array $vendorParams)
    {
        $this->vendorParams = $vendorParams;
    }

    /**
     * @return mixed
     */
    public function getNetAmount()
    {
        return $this->netAmount;
    }

    /**
     * @param mixed $netAmount
     */
    public function setNetAmount($netAmount)
    {
        $this->netAmount = $netAmount;
    }

    /**
     * @return mixed
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * @param mixed $commission
     */
    public function setCommission($commission)
    {
        $this->commission = $commission;
    }

    /**
     * @return mixed
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param mixed $requestId
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
    }
}