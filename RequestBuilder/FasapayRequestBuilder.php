<?php

namespace TwoDudes\FXPay\RequestBuilder;

use TwoDudes\FXPay\MerchantConfig\AbstractConfig;
use TwoDudes\FXPay\MerchantConfig\FasapayConfig;
use TwoDudes\FXPay\PaymentRequest\PaymentRequestInterface;

/**
 * Class FasapayRequestBuilder
 * @package TwoDudes\FXPay\RequestBuilder
 */
class FasapayRequestBuilder implements RequestBuilderInterface
{
    /**
     * @param AbstractConfig $config
     * @param PaymentRequestInterface $request
     * @return array
     * @throws \Exception
     */
    public function buildRequest(AbstractConfig $config, PaymentRequestInterface $request)
    {
        if (!$config instanceof FasapayConfig) {
            throw new \Exception();
        }

        return [
            'fp_acc'            => $config->getMerchantAccount(),
            'fp_store'          => $config->getStore(),
            'fp_merchant_ref'   => $request->getId(),
            'fp_item'           => $request->getDescription(),
            'fp_amnt'           => $request->getAmount(),
            'fp_currency'       => $request->getCurrency(),
            'fp_comments'       => $request->getDescription(),
            'fp_fee_mode'       => $config->getFeeMode(),
            'fp_status_url'     => $config->getNotificationUrl(),
            'fp_success_url'    => $config->getSuccessUrl(),
            'fp_fail_url'       => $config->getErrorUrl(),
        ];
    }
}