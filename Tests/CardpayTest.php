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
use TwoDudes\FXPay\MerchantConfig\CardpayConfig;
use TwoDudes\FXPay\PaymentRequest\Customer;
use TwoDudes\FXPay\PaymentRequest\PaymentRequest;
use TwoDudes\FXPay\PaymentRequest\PaymentRequestInterface;
use TwoDudes\FXPay\RequestBuilder\CardpayRequestBuilder;
use TwoDudes\FXPay\ResponseBuilder\CardpayResponseBuilder;
use TwoDudes\FXPay\ResponseValidator\CardpayResponseValidator;

/**
 * Class RegistrationTest
 * @package Hiwayfx\CabinetBundle\Tests
 */
class CardpayTest extends \PHPUnit_Framework_TestCase
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
    public function testCardPaySuccessfull()
    {
        $requestBuilder = new CardpayRequestBuilder();
        $sha512 = $requestBuilder->buildRequest($this->strategy->getConfig(), $this->request)['sha512'];

        $content = $this->strategy->buildRequest(new CardpayRequestBuilder(), $this->request);
        $this->assertContains($sha512, $content);

        $order = sprintf('<order id="212945351" refund_id="213859009" number="%s" status="APPROVED" description="APPROVED" 
                                 date="18.07.2016 05:53:55" is_3d="true" approval_code="00020Z" amount="%s" refunded="1211.53" 
                                 currency="%s" card_num="%s" />', $this->request->getId(), $this->request->getAmount(), $this->request->getCurrency(), '538738...5232');
        $responseParams = [
            'orderXML' => base64_encode($order),
            'sha512' => '706a022f585a0486d7915b60b8d43cd21154bf21088a0fc727f0c1ebd71d3cf3d611c6200931f447be11129d91fe0eb1d2e05094a39c2c2e3666a1ecee4ce734'
        ];

        $response = $this->strategy->processResponse(new CardpayResponseValidator($this->request), new CardpayResponseBuilder(), $responseParams);

        $this->assertEquals($response->getAmount(), 100);
        $this->assertEquals($response->getCurrency(), 'USD');
        $this->assertEquals($response->getRequestId(), 5);
    }

    /**
     *
     */
    public function testCardPayError()
    {
        $order = sprintf('<order id="212945351" refund_id="213859009" number="%s" status="ERROR" description="APPROVED" 
                                 date="18.07.2016 05:53:55" is_3d="true" approval_code="00020Z" amount="%s" refunded="1211.53" 
                                 currency="%s" card_num="%s" />', $this->request->getId(), $this->request->getAmount(), $this->request->getCurrency(), '538738...5232');
        $responseParams = [
            'orderXML' => base64_encode($order),
            'sha512' => '706a022f585a0486d7915b60b8d43cd21154bf21088a0fc727f0c1ebd71d3cf3d611c6200931f447be11129d91fe0eb1d2e05094a39c2c2e3666a1ecee4ce734'
        ];
        $config = new CardpayConfig();
        $config->setSecret('b5AW12C8gjwK');

        $strategy = new FormWithRedirectStrategy($config);
        $response = $strategy->processResponse(new CardpayResponseValidator($this->request), new CardpayResponseBuilder(), $responseParams);

        $this->assertEquals($response, false);
    }

    /**
     *
     */
    public function setUp()
    {
        $config = new CardpayConfig();
        $config->setSecret('b5AW12C8gjwK');
        $config->setWalletId('123123');

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