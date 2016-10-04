<?php

namespace TwoDudes\FXPay\ResponseBuilder;

use TwoDudes\FXPay\Deposit\DepositRequestInterface;
use TwoDudes\FXPay\MerchantConfig\AbstractConfig;
use TwoDudes\FXPay\PaymentResponse;

/**
 * Created by PhpStorm.
 * User: vasiliy
 * Date: 04/10/2016
 * Time: 12:25 ΜΜ
 */
interface ResponseBuilderInterface
{
    /**
     * @param array $responseParams
     * @return PaymentResponse
     */
    public function buildResponse(array $responseParams);
}