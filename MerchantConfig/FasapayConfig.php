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
class FasapayConfig extends AbstractConfig
{
    /**
     * @var
     */
    private $merchantAccount;

    /**
     * @var
     */
    private $secretWord;

    /**
     * @var
     */
    private $store;

    /**
     * @var string
     */
    private $feeMode = 'FIS';

    /**
     * @return mixed
     */
    public function getFeeMode()
    {
        return $this->feeMode;
    }

    /**
     * @param mixed $feeMode
     */
    public function setFeeMode($feeMode)
    {
        $this->feeMode = $feeMode;
    }

    /**
     * @return mixed
     */
    public function getMerchantAccount()
    {
        return $this->merchantAccount;
    }

    /**
     * @param mixed $merchantAccount
     */
    public function setMerchantAccount($merchantAccount)
    {
        $this->merchantAccount = $merchantAccount;
    }

    /**
     * @return mixed
     */
    public function getSecretWord()
    {
        return $this->secretWord;
    }

    /**
     * @param mixed $secretWord
     */
    public function setSecretWord($secretWord)
    {
        $this->secretWord = $secretWord;
    }

    /**
     * @return mixed
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param mixed $store
     */
    public function setStore($store)
    {
        $this->store = $store;
    }

    /**
     * @return string
     */
    public function getVendorName()
    {
        return 'fasapay';
    }
}