<?php


namespace Ipol\Ozon\Api\Entity\Response;


/**
 * Class DeliveryTime
 * @package Ipol\Ozon\Api
 * @subpackage Response
 */
class DeliveryTime extends AbstractResponse
{
    /**
     * @var int
     */
    protected $days;

    /**
     * @return int
     */
    public function getDays(): int
    {
        return $this->days;
    }

    /**
     * @param int $days
     * @return DeliveryTime
     */
    public function setDays(int $days): DeliveryTime
    {
        $this->days = $days;
        return $this;
    }

}