<?php

namespace TwoDudes\FXPay\PaymentRequest;

/**
 * Class PaymentRequest
 * @package TwoDudes\FXPay\DepositRequest
 */
class Customer implements CustomerInterface
{
    private $email;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}