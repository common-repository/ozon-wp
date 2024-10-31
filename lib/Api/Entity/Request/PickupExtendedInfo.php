<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class PickupExtendedInfo
 * @package Ipol\Ozon\Api\Entity\Request
 */
class PickupExtendedInfo extends AbstractRequest
{

    /**
     * @var string
     */
    protected $deliveryVariantId;

    /**
     * PickupExtendedInfo constructor.
     * @param string $deliveryVariantId
     */
    public function __construct(string $deliveryVariantId)
    {
        parent::__construct();
        $this->deliveryVariantId = $deliveryVariantId;
    }

    /**
     * @return string
     */
    public function getDeliveryVariantId(): string
    {
        return $this->deliveryVariantId;
    }

    /**
     * @param string $deliveryVariantId
     * @return PickupExtendedInfo
     */
    public function setDeliveryVariantId(string $deliveryVariantId): PickupExtendedInfo
    {
        $this->deliveryVariantId = $deliveryVariantId;
        return $this;
    }

}