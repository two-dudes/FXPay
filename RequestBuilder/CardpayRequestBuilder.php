<?php

namespace TwoDudes\FXPay\RequestBuilder;

use TwoDudes\FXPay\MerchantConfig\AbstractConfig;
use TwoDudes\FXPay\MerchantConfig\CardpayConfig;
use TwoDudes\FXPay\PaymentRequest\PaymentRequestInterface;
use TwoDudes\FXPay\Utils\CardpayUtils;

/**
 * Class CardpayRequestBuilder
 * @package TwoDudes\FXPay\RequestBuilder
 */
class CardpayRequestBuilder implements RequestBuilderInterface
{
    /**
     * @param AbstractConfig $config
     * @return array
     * @throws \Exception
     */
    public function buildRequest(AbstractConfig $config, PaymentRequestInterface $request)
    {
        if (!$config instanceof CardpayConfig) {
            throw new \Exception();
        }

        $params = [];
        $params['wallet_id'] = $config->getWalletId();
        $params['number'] = $request->getId();
        $params['description'] = $request->getDescription();
        $params['currency'] = $request->getCurrency();
        $params['amount'] = $request->getAmount();
        $params['email'] = $request->getCustomer()->getEmail();
        $params['success_url'] = $config->getSuccessUrl();
        $params['decline_url'] = $config->getErrorUrl();
        $params['cancel_url'] = $config->getErrorUrl();

        $xmlRequest = CardpayUtils::buildXmlRequest($params);

        return [
            'orderXML' => base64_encode($xmlRequest),
            'sha512' => CardpayUtils::buildDigest($params, $config->getSecret()),
        ];
    }
}