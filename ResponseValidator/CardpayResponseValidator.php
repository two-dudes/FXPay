<?php

namespace TwoDudes\FXPay\ResponseValidator;

use TwoDudes\FXPay\MerchantConfig\AbstractConfig;
use TwoDudes\FXPay\MerchantConfig\CardpayConfig;
use TwoDudes\FXPay\PaymentRequest\PaymentRequestInterface;
use TwoDudes\FXPay\ResponseValidator\Exception\InvalidResponseException;
use TwoDudes\FXPay\Utils\CardpayUtils;

/**
 * Class FasapayResponseValidator
 * @package TwoDudes\FXPay\ResponseValidator
 */
class CardpayResponseValidator implements ResponseValidatorInterface
{
    /**
     * @var PaymentRequestInterface
     */
    private $request;

    /**
     * CardpayResponseValidator constructor.
     * @param $request
     */
    public function __construct(PaymentRequestInterface $request)
    {
        $this->request = $request;
    }


    /**
     * @param AbstractConfig $config
     * @param array $responseParams
     * @return bool
     * @throws InvalidResponseException
     * @throws \Exception
     */
    public function validate(AbstractConfig $config, array $responseParams)
    {
        if (!$config instanceof CardpayConfig) {
            throw new \Exception();
        }

        $order = base64_decode($responseParams['orderXML']);
        $xml = simplexml_load_string($order);

        $params = [];
        $params['wallet_id'] = $config->getWalletId();
        $params['number'] = (string) $xml->attributes()->number;
        $params['description'] = $this->request->getDescription();
        $params['currency'] = (string) $xml->attributes()->currency;
        $params['amount'] = (string) $xml->attributes()->amount;
        $params['email'] = $this->request->getCustomer()->getEmail();
        $status = (string) $xml->attributes()->status;

        $digest = CardpayUtils::buildDigest($params, $config->getSecret());
        $responseDigest = $responseParams['sha512'];
        if ($digest != $responseDigest) {
            throw new InvalidResponseException();
        }

        if ($status != 'APPROVED') {
            throw new InvalidResponseException();
        }

        return true;
    }
}