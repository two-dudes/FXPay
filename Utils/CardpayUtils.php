<?php

namespace TwoDudes\FXPay\Utils;

/**
 * Class CardpayDigestBuilder
 */
class CardpayUtils
{
    /**
     * @param array $params
     * @param $secret
     * @return string
     */
    public static function buildXmlRequest(array $params)
    {
        return sprintf('<order wallet_id="%s" number="%s" description="%s" currency="%s" amount="%s" email="%s"/>',
            $params['wallet_id'],
            $params['number'],
            $params['description'],
            $params['currency'],
            $params['amount'],
            $params['email']
        );
    }

    /**
     * @param array $params
     * @param $secret
     * @return string
     */
    public static function buildDigest(array $params, $secret)
    {
        return hash('sha512', self::buildXmlRequest($params). $secret);
    }
}