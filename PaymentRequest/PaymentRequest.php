<?php


namespace TwoDudes\FXPay\PaymentRequest;

/**
 * Class PaymentRequest
 * @package TwoDudes\FXPay\DepositRequest
 */
class PaymentRequest implements PaymentRequestInterface
{
    /**
     * @var
     */
    private $amount;

    /**
     * @var
     */
    private $currency;

    /**
     * @var
     */
    private $id;

    /**
     * @var CustomerInterface
     */
    private $customer;

    /**
     * @var
     */
    private $description;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return sprintf('Deposit %s %s', $this->amount, $this->getCurrency());
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    /**
     * @return CustomerInterface
     */
    public function getCustomer(): CustomerInterface
    {
        return $this->customer;
    }

    /**
     * @param CustomerInterface $customer
     */
    public function setCustomer(CustomerInterface $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}