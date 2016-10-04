<?php
/**
 * Created by PhpStorm.
 * User: vin
 * Date: 4/14/14
 * Time: 5:31 PM
 */

namespace TwoDudes\FXPay\Tests;

use TwoDudes\FXPay\Events\EventManager;
use TwoDudes\FXPay\HandlerStrategy\FormWithRedirectStrategy;
use TwoDudes\FXPay\MerchantConfig\FasapayConfig;
use TwoDudes\FXPay\PaymentRequest\Customer;
use TwoDudes\FXPay\PaymentRequest\PaymentRequest;
use TwoDudes\FXPay\PaymentRequest\PaymentRequestInterface;
use TwoDudes\FXPay\RequestBuilder\FasapayRequestBuilder;
use TwoDudes\FXPay\ResponseBuilder\FasapayResponseBuilder;
use TwoDudes\FXPay\ResponseValidator\FasapayResponseValidator;

/**
 * Class RegistrationTest
 * @package Hiwayfx\CabinetBundle\Tests
 */
class FasapayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FormWithRedirectStrategy
     */
    private $strategy;

    /**
     * @var PaymentRequestInterface
     */
    private $request;

    /**
     *
     */
    public function testPaySuccessfull()
    {
        // request
        $content = $this->strategy->buildRequest(new FasapayRequestBuilder(), $this->request);
        $this->assertContains('document.getElementById("FXPayForm").submit();', $content);

        // response
        $responseParams = [
            'fp_paidto' => 'FP86918',
            'fp_paidby' => 'FP138358',
            'fp_amnt' => $this->request->getAmount(),
            'fp_fee_amnt' => 5,
            'fp_fee_mode' => 'FiR',
            'fp_total' => $this->request->getAmount(),
            'fp_currency' => $this->request->getCurrency(),
            'fp_batchnumber' => 'TR2016092258298',
            'fp_store' => 'store',
            'fp_timestamp' => '2016-09-22 21:16:35',
            'fp_unix_time' => '1474553795',
            'fp_merchant_ref' => $this->request->getId(),
            'fp_sec_field' => '',
            'fp_hash' => '35a03fa4ae1edbf4cb2f0746ee725168fc2baaa34af5c1d23690f1d3acbbfc7e',
        ];

        $response = $this->strategy->processResponse(new FasapayResponseValidator(), new FasapayResponseBuilder(), $responseParams);

        $this->assertEquals($response->getAmount(), 100);
        $this->assertEquals($response->getCurrency(), 'USD');
        $this->assertEquals($response->getRequestId(), 5);
    }

    /**
     *
     */
    public function setUp()
    {
        $config = new FasapayConfig();
        $config->setSecretWord('secretword');
        $config->setMerchantAccount('123123');

        $id = 5;
        $amount = 100;
        $currency = 'USD';

        $customer = new Customer();
        $customer->setEmail('test@gmail.com');

        $request = new PaymentRequest();
        $request->setId($id);
        $request->setAmount($amount);
        $request->setCurrency($currency);
        $request->setCustomer($customer);

        $this->strategy = new FormWithRedirectStrategy($config);
        $this->strategy->setEventManager(new EventManager());

        $this->request = $request;
    }
}