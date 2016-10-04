<?php

namespace TwoDudes\FXPay\ResponseBuilder;

use TwoDudes\FXPay\PaymentResponse;

/**
 * Created by PhpStorm.
 * User: vasiliy
 * Date: 04/10/2016
 * Time: 12:25 ΜΜ
 */
class CardpayResponseBuilder implements ResponseBuilderInterface
{
    /**
     * @param array $responseParams
     * @return PaymentResponse
     */
    public function buildResponse(array $responseParams)
    {
        $order = base64_decode($responseParams['orderXML']);

        $xml = simplexml_load_string($order);

        $amount = (string) $xml->attributes()->amount;
        $currency = (string) $xml->attributes()->currency;
        $cardNumber = (string) $xml->attributes()->card_num;
        $requestId = (string) $xml->attributes()->number;

        $response = new PaymentResponse();
        $response->setAmount((float) $amount);
        $response->setCurrency($currency);
        $response->setVendorParams($responseParams);
        $response->setWallet($cardNumber);
        $response->setRequestId($requestId);
        return $response;
    }
}