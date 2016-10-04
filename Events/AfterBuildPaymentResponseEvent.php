<?php

namespace TwoDudes\FXPay\Events;
use TwoDudes\FXPay\PaymentResponse;

/**
 * Class BeforeRequestBuildEvent
 */
class AfterBuildPaymentResponseEvent implements EventInterface
{
    /**
     * @var PaymentResponse
     */
    private $paymentResponse;

    /**
     * @return PaymentResponse
     */
    public function getPaymentResponse()
    {
        return $this->paymentResponse;
    }

    /**
     * @param PaymentResponse $paymentResponse
     */
    public function setPaymentResponse(PaymentResponse $paymentResponse)
    {
        $this->paymentResponse = $paymentResponse;
    }

    /**
     * @return string
     */
    public static function getName()
    {
        return 'fxpay.after.build.payment.response';
    }
}