<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class DeliveryTime
 * @package Ipol\Ozon\Api
 * @subpackage Request
 */
class DeliveryTime extends AbstractRequest
{
    /**
     * @var int
     */
    protected $fromPlaceId;
    /**
     * @var int
     */
    protected $deliveryVariantId;

    /**
     * DeliveryTime constructor.
     * @param int $fromPlaceId
     * @param int $deliveryVariantId
     */
    public function __construct(int $fromPlaceId, int $deliveryVariantId)
    {
        parent::__construct();
        $this->fromPlaceId = $fromPlaceId;
        $this->deliveryVariantId = $deliveryVariantId;
    }

    /**
     * @return int
     */
    public function getFromPlaceId(): int
    {
        return $this->fromPlaceId;
    }

    /**
     * @return int
     */
    public function getDeliveryVariantId(): int
    {
        return $this->deliveryVariantId;
    }

}