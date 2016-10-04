<?php

namespace TwoDudes\FXPay\Events;

/**
 * Class BeforeRequestBuildEvent
 */
class AfterFormBuildEvent implements EventInterface
{
    /**
     * @var string
     */
    private $content;

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public static function getName()
    {
        return 'fxpay.after.form.build';
    }
}