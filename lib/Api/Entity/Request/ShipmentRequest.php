<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class ShipmentRequest
 * @package Ipol\Ozon\Api
 * @subpakage Request
 */
class ShipmentRequest extends AbstractRequest
{
    /**
     * @var int[]
     */
    protected $orderIds;

    public function __construct(array $orderIds)
    {
        parent::__construct();
        $this->setOrderIds($orderIds);
    }

    /**
     * @return int[]
     */
    public function getOrderIds(): array
    {
        return $this->orderIds;
    }

    /**
     * @param int[] $orderIds
     * @return ShipmentRequest
     */
    public function setOrderIds(array $orderIds): ShipmentRequest
    {
        $this->orderIds = $orderIds;
        return $this;
    }

}