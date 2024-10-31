<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\OrderById;


use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class DesiredDeliveryTimeInterval
 * @package Ipol\Ozon\Api\Entity\Response\Part\OrderById
 */
class DesiredDeliveryTimeInterval extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var string DateTime
     */
    protected $from;
    /**
     * @var string DateTime
     */
    protected $to;

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @param string $from
     * @return DesiredDeliveryTimeInterval
     */
    public function setFrom(string $from): DesiredDeliveryTimeInterval
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $to
     * @return DesiredDeliveryTimeInterval
     */
    public function setTo(string $to): DesiredDeliveryTimeInterval
    {
        $this->to = $to;
        return $this;
    }

}