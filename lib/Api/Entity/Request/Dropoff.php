<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class Dropoff
 * @package Ipol\Ozon\Api\Entity\Request
 */
class Dropoff extends AbstractRequest
{
    /**
     * @var int[]
     */
    protected $orderIds;

    /**
     * @return int[]
     */
    public function getOrderIds(): array
    {
        return $this->orderIds;
    }

    /**
     * @param int[] $orderIds
     * @return Dropoff
     */
    public function setOrderIds(array $orderIds): Dropoff
    {
        $this->orderIds = $orderIds;
        return $this;
    }

}