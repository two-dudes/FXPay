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
class CardpayConfig extends AbstractConfig
{
    /**
     * @var
     */
    private $walletId;

    /**
     * @var
     */
    private $secret;

    /**
     * @return mixed
     */
    public function getWalletId()
    {
        return $this->walletId;
    }

    /**
     * @param mixed $walletId
     */
    public function setWalletId($walletId)
    {
        $this->walletId = $walletId;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return string
     */
    public function getVendorName()
    {
        return 'cardpay';
    }
}