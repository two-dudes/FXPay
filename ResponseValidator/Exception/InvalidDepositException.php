<?php

namespace TwoDudes\FXPay\ResponseValidator\Exception;

/**
 * Class InvalidDepositException
 * @package TwoDudes\FXPay\ResponseValidator\Exception
 */
class InvalidDepositException extends \Exception
{
    /**
     * InvalidDepositException constructor.
     */
    public function __construct()
    {
        parent::__construct("Invalid deposit found in reponse");
    }
}