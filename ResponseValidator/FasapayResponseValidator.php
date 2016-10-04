<?php

namespace TwoDudes\FXPay\ResponseValidator;

use TwoDudes\FXPay\MerchantConfig\AbstractConfig;
use TwoDudes\FXPay\MerchantConfig\FasapayConfig;
use TwoDudes\FXPay\ResponseValidator\Exception\InvalidDepositException;
use TwoDudes\FXPay\ResponseValidator\Exception\InvalidResponseException;

/**
 * Class FasapayResponseValidator
 * @package TwoDudes\FXPay\ResponseValidator
 */
class FasapayResponseValidator implements ResponseValidatorInterface
{
    /**
     * @param AbstractConfig $config
     * @param array $responseParams
     * @return bool
     * @throws InvalidDepositException
     * @throws InvalidResponseException
     * @throws \Exception
     */
    public function validate(AbstractConfig $config, array $responseParams)
    {
        if (!$config instanceof FasapayConfig) {
            throw new \Exception('Wrong config supplied');
        }

        $hashString = implode(':', array(
            $responseParams['fp_paidto'],
            $responseParams['fp_paidby'],
            $responseParams['fp_store'],
            $responseParams['fp_amnt'],
            $responseParams['fp_batchnumber'],
            $responseParams['fp_currency'],
            $config->getSecretWord()
        ));

        $hash = hash('sha256', $hashString);

        if ($hash != $responseParams['fp_hash']) {
            throw new InvalidResponseException();
        }

        if (empty($responseParams['fp_merchant_ref'])) {
            throw new InvalidDepositException();
        }

        return true;
    }
}