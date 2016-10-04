<?php
/**
 * Created by PhpStorm.
 * User: vasiliy
 * Date: 04/10/2016
 * Time: 12:26 ΜΜ
 */

namespace TwoDudes\FXPay\MerchantConfig;


/**
 * Class FasapayConfig
 * @package TwoDudes\FXPay\MerchantConfig
 */
/**
 * Class AbstractConfig
 * @package TwoDudes\FXPay\MerchantConfig
 */
abstract class AbstractConfig
{
    /**
     * @var
     */
    protected $vendorUrl;

    /**
     * @var
     */
    protected $successUrl;

    /**
     * @var
     */
    protected $errorUrl;

    /**
     * @var
     */
    protected $notificationUrl;

    /**
     * @return mixed
     */
    public function getSuccessUrl()
    {
        return $this->successUrl;
    }

    /**
     * @param mixed $successUrl
     */
    public function setSuccessUrl($successUrl)
    {
        $this->successUrl = $successUrl;
    }

    /**
     * @return mixed
     */
    public function getErrorUrl()
    {
        return $this->errorUrl;
    }

    /**
     * @param mixed $errorUrl
     */
    public function setErrorUrl($errorUrl)
    {
        $this->errorUrl = $errorUrl;
    }

    /**
     * @return mixed
     */
    public function getNotificationUrl()
    {
        return $this->notificationUrl;
    }

    /**
     * @param mixed $notificationUrl
     */
    public function setNotificationUrl($notificationUrl)
    {
        $this->notificationUrl = $notificationUrl;
    }

    /**
     * @return mixed
     */
    abstract public function getVendorName();

    /**
     * @return mixed
     */
    public function getVendorUrl()
    {
        return $this->vendorUrl;
    }

    /**
     * @param mixed $vendorUrl
     */
    public function setVendorUrl($vendorUrl)
    {
        $this->vendorUrl = $vendorUrl;
    }
}