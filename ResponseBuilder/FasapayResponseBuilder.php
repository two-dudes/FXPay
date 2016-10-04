<?php

namespace TwoDudes\FXPay\ResponseBuilder;

use TwoDudes\FXPay\Deposit\DepositRequestInterface;
use TwoDudes\FXPay\MerchantConfig\AbstractConfig;
use TwoDudes\FXPay\MerchantConfig\FasapayConfig;
use TwoDudes\FXPay\PaymentResponse;

/**
 * Created by PhpStorm.
 * User: vasiliy
 * Date: 04/10/2016
 * Time: 12:25 ΜΜ
 */
class FasapayResponseBuilder implements ResponseBuilderInterface
{
    /**
     * @param array $responseParams
     * @return PaymentResponse
     */
    public function buildResponse(array $responseParams)
    {
        $response = new PaymentResponse();
        $response->setAmount($responseParams['fp_amnt']);
        $response->setCurrency($responseParams['fp_currency']);
        $response->setCommission($responseParams['fp_fee_amnt']);
        $response->setNetAmount($responseParams['fp_amnt'] - $responseParams['fp_fee_amnt']);
        $response->setVendorParams($responseParams);
        $response->setWallet($responseParams['fp_paidby']);
        $response->setRequestId($responseParams['fp_merchant_ref']);
        return $response;
    }
}