<?php
/**
 * Created by PhpStorm.
 * User: vasiliy
 * Date: 6/3/14
 * Time: 3:31 PM
 */

namespace TwoDudes\FXPay\HandlerStrategy;

use TwoDudes\FXPay\Events\AfterBuildPaymentResponseEvent;
use TwoDudes\FXPay\Events\AfterFormBuildEvent;
use TwoDudes\FXPay\Events\AfterRequestBuildEvent;
use TwoDudes\FXPay\Events\BeforeProcessResponseEvent;
use TwoDudes\FXPay\PaymentRequest\PaymentRequestInterface;
use TwoDudes\FXPay\PaymentResponse;
use TwoDudes\FXPay\RequestBuilder\RequestBuilderInterface;
use TwoDudes\FXPay\ResponseBuilder\ResponseBuilderInterface;
use TwoDudes\FXPay\ResponseValidator\Exception\InvalidDepositException;
use TwoDudes\FXPay\ResponseValidator\Exception\InvalidResponseException;
use TwoDudes\FXPay\ResponseValidator\ResponseValidatorInterface;

/**
 * Class G2SHandler
 * @package Hiwayfx\Core\DepositBundle\VendorHandler
 */
class FormWithRedirectStrategy extends AbstractStrategy
{
    /**
     * @param RequestBuilderInterface $requestBuilder
     * @param PaymentRequestInterface $deposit
     * @return mixed
     */
    public function buildRequest(RequestBuilderInterface $requestBuilder, PaymentRequestInterface $deposit)
    {
        $this->log("Processing %s deposit %s", $this->config->getVendorName(), $deposit->getId());

        $params = $requestBuilder->buildRequest($this->config, $deposit);

        $event = new AfterRequestBuildEvent();
        $event->setParams($params);
        $this->dispatch($event);
        $params = $event->getParams();

        $this->log("Build params: %s", json_encode($params));

        $content = $this->generateForm($params);
        $this->log("Generated form: %s", $content);

        $event = new AfterFormBuildEvent();
        $event->setContent($content);
        $this->dispatch($event);
        $content = $event->getContent();

        return $content;
    }

    /**
     * @param ResponseValidatorInterface $responseValidator
     * @param ResponseBuilderInterface $responseBuilder
     * @param array $responseParams
     * @return PaymentResponse|false
     */
    public function processResponse(ResponseValidatorInterface $responseValidator, ResponseBuilderInterface $responseBuilder, array $responseParams = [])
    {
        $this->log('Received %s process request', $this->config->getVendorName());
        $this->log('Received params %s', json_encode($responseParams));

        $event = new BeforeProcessResponseEvent();
        $event->setParams($responseParams);
        $this->dispatch($event);
        $responseParams = $event->getParams();

        try {
            $responseValidator->validate($this->config, $responseParams);
        } catch (InvalidDepositException $e) {
            $this->log("Invalid deposit");
            return false;
        } catch (InvalidResponseException $e) {
            $this->log("Invalid response");
            return false;
        }

        $response = $responseBuilder->buildResponse($responseParams);
        $response->setHandler($this->config->getVendorName());

        $event = new AfterBuildPaymentResponseEvent();
        $event->setPaymentResponse($response);
        $this->dispatch($event);
        $response = $event->getPaymentResponse();

        return $response;
    }

    /**
     * @param $params
     * @return string
     */
    protected function generateForm($params):string
    {
        $content = '<form action="' . $this->config->getVendorUrl() . '" method="POST" id="FXPayForm" style="display: none">';
        foreach ($params as $name => $value) {
            $content .= ' <input type="text" name="' . $name . '" value="' . $value . '"></br>';
        }
        $content .= '<input type="submit"></form>';
        $content .= '<script type="text/javascript">window.onload = function() { document.getElementById("FXPayForm").submit(); }</script>';
        return $content;
    }
}