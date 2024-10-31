<?php


namespace Ipol\Ozon\Api\Entity\Common\Part;


use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class ApprovedDeliveryTime
 * @package Ipol\Ozon\Api
 * @subpackage Entity
 */
class ApprovedDeliveryTime extends AbstractEntity
{
    /**
     * @var string (DateTime)
     */
    protected $date;
    /**
     * @var string (DateTime)
     */
    protected $timeFrom;
    /**
     * @var string (DateTime)
     */
    protected $timeTo;

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return ApprovedDeliveryTime
     */
    public function setDate(string $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimeFrom(): string
    {
        return $this->timeFrom;
    }

    /**
     * @param string $timeFrom
     * @return ApprovedDeliveryTime
     */
    public function setTimeFrom(string $timeFrom)
    {
        $this->timeFrom = $timeFrom;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimeTo(): string
    {
        return $this->timeTo;
    }

    /**
     * @param string $timeTo
     * @return ApprovedDeliveryTime
     */
    public function setTimeTo(string $timeTo)
    {
        $this->timeTo = $timeTo;
        return $this;
    }

}