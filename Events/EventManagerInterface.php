<?php

namespace TwoDudes\FXPay\Events;

/**
 * Interface EventManagerInterface
 * @package TwoDudes\FXPay\Events
 */
interface EventManagerInterface
{
    /**
     * @param $eventName
     * @param $listener
     * @return mixed
     */
    public function attach($eventName, callable $listener);

    /**
     * @param EventInterface $event
     * @return mixed
     */
    public function dispatch(EventInterface $event);
}