<?php

namespace TwoDudes\FXPay\Events;

/**
 * Class EventManager
 * @package TwoDudes\FXPay\Events
 */
class EventManager implements EventManagerInterface
{
    /**
     * @var array
     */
    protected $listeners = [];

    /**
     * @param $eventName
     * @param $listener
     * @return void
     */
    public function attach($eventName, callable $listener)
    {
        if (!isset($this->listeners[$eventName])) {
            $this->listeners[$eventName] = [];
        }
        $this->listeners[$eventName][] = $listener;
    }

    /**
     * @param EventInterface $event
     * @return void
     */
    public function dispatch(EventInterface $event)
    {
        if (isset($this->listeners[$event->getName()])) {
            foreach ($this->listeners[$event->getName()] as $listener) {
                call_user_func($listener, $event);
            }
        }
    }
}