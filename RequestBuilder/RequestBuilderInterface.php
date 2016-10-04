<?php

namespace TwoDudes\FXPay\RequestBuilder;

use TwoDudes\FXPay\MerchantConfig\AbstractConfig;
use TwoDudes\FXPay\PaymentRequest\PaymentRequestInterface;

/**
 * Class AbstractRequestBuilder
 * @package TwoDudes\FXPay\RequestBuilder
 */
interface RequestBuilderInterface
{
    /**
     * @param AbstractConfig $config
     * @param PaymentRequestInterface $request
     * @return array
     */
    public function buildRequest(AbstractConfig $config, PaymentRequestInterface $request);
}