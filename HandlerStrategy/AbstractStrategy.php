<?php
/**
 * Created by PhpStorm.
 * User: vasiliy
 * Date: 04/10/2016
 * Time: 12:19 ΜΜ
 */

namespace TwoDudes\FXPay\HandlerStrategy;

use Psr\Log\LoggerInterface;
use TwoDudes\FXPay\Events\EventInterface;
use TwoDudes\FXPay\Events\EventManagerInterface;
use TwoDudes\FXPay\MerchantConfig\AbstractConfig;

/**
 * Class AbstractHandler
 * @package TwoDudes\FXPay\Handler
 */
abstract class AbstractStrategy
{
    /**
     * @var AbstractConfig
     */
    protected $config;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var EventManagerInterface
     */
    protected $eventManager;

    /**
     * @param AbstractConfig $config
     */
    public function __construct(AbstractConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param mixed $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return EventManagerInterface
     */
    public function getEventManager(): EventManagerInterface
    {
        return $this->eventManager;
    }

    /**
     * @param EventManagerInterface $eventManager
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * @param $msg
     */
    protected function log($msg)
    {
        if ($this->logger !== null) {
            $args = func_get_args();
            $log = call_user_func_array('sprintf', $args);
            $this->logger->info($log);
        }
    }

    /**
     * @param EventInterface $event
     */
    protected function dispatch(EventInterface $event)
    {
        if ($this->eventManager !== null) {
            $this->eventManager->dispatch($event);
        }
    }

    /**
     * @return AbstractConfig
     */
    public function getConfig()
    {
        return $this->config;
    }
}