<?php

namespace TwoDudes\FXPay\Events;

/**
 * Class BeforeRequestBuildEvent
 */
class AfterRequestBuildEvent implements EventInterface
{
    /**
     * @var array
     */
    private $params;

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return string
     */
    public static function getName()
    {
        return 'fxpay.after.request.build';
    }
}