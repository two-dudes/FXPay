<?php

namespace TwoDudes\FXPay\Events;

/**
 * Interface EventInterface
 * @package TwoDudes\FXPay\Events
 */
interface EventInterface
{
    /**
     * @return string
     */
    public static function getName();
}