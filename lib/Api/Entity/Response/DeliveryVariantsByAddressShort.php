<?php


namespace Ipol\Ozon\Api\Entity\Response;


/**
 * Class DeliveryVariantsByAddressShort
 * @package Ipol\Ozon\Api\Entity\Response
 */
class DeliveryVariantsByAddressShort extends AbstractResponse
{
    /**
     * @var int[]
     */
    protected $deliveryVariantIds;

    /**
     * @return int[]
     */
    public function getDeliveryVariantIds(): array
    {
        return $this->deliveryVariantIds;
    }

    /**
     * @param int[] $deliveryVariantIds
     * @return DeliveryVariantsByAddressShort
     */
    public function setDeliveryVariantIds(array $deliveryVariantIds): DeliveryVariantsByAddressShort
    {
        $this->deliveryVariantIds = $deliveryVariantIds;
        return $this;
    }
}