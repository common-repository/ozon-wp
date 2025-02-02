<?php


namespace Ipol\Ozon\Api\Adapter;


use InvalidArgumentException;
use Ipol\Ozon\Api\Logger\Psr\Log\LoggerInterface;
use Ipol\Ozon\Api\Logger\Psr\Log\NullLogger;


abstract class AbstractAdapter
{
    /**
     * @var LoggerInterface
     */
    protected $log;

    /**
     * AbstractAdapter constructor.
     */
    public function __construct()
    {
        $this->log = new NullLogger();
    }

    /**
     * @return LoggerInterface
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * @param LoggerInterface $log
     * @return $this
     */
    public function setLog($log)
    {
        if(!is_a($log, LoggerInterface::class)) {
            throw new InvalidArgumentException();
        }

        $this->log = $log;
        return $this;
    }

}