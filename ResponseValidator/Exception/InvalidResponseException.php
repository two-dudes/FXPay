<?php

namespace TwoDudes\FXPay\ResponseValidator\Exception;

/**
 * Class InvalidResponseException
 * @package TwoDudes\FXPay\ResponseValidator\Exception
 */
class InvalidResponseException extends \Exception
{
    /**
     * InvalidResponseException constructor.
     */
    public function __construct()
    {
        parent::__construct("Invalid response");
    }
}