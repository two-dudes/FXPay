<?php

namespace TwoDudes\FXPay\ResponseValidator;

use TwoDudes\FXPay\MerchantConfig\AbstractConfig;
use TwoDudes\FXPay\PaymentRequest\PaymentRequest;

/**
 * Created by PhpStorm.
 * User: vasiliy
 * Date: 04/10/2016
 * Time: 12:49 ΜΜ
 */
interface ResponseValidatorInterface
{
    public function validate(AbstractConfig $config, array $responseParams);
}