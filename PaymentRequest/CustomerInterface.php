<?php


namespace TwoDudes\FXPay\PaymentRequest;


/**
 * Interface CustomerInfoInterface
 * @package TwoDudes\FXPay\DepositRequest
 */
interface CustomerInterface
{
    /**
     * @return mixed
     */
    public function getEmail();
}