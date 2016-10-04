<?php
/**
 * Created by PhpStorm.
 * User: vasiliy
 * Date: 04/10/2016
 * Time: 12:22 ΜΜ
 */

namespace TwoDudes\FXPay\PaymentRequest;

/**
 * Interface PaymentRequestInterface
 * @package TwoDudes\FXPay\DepositRequest
 */
interface PaymentRequestInterface
{
    /**
     * @return mixed
     */
    public function getAmount();

    /**
     * @return mixed
     */
    public function getCurrency();

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return CustomerInterface
     */
    public function getCustomer();

    /**
     * @return mixed
     */
    public function getDescription();
}