<?php
namespace Ipol\Ozon\Api\Entity\Request;

/**
 * Class DeliveryCalculate
 * @package Ipol\Ozon\Api\Entity\Request
 */
class DeliveryCalculate extends AbstractRequest
{
    /**
     * @var int
     */
    protected $deliveryVariantId;

    /**
     * @var float
     */
    protected $weight;

    /**
     * @var int
     */
    protected $fromPlaceId;

    /**
     * @var float
     */
    protected $estimatedPrice;

    /**
     * @return int
     */
    public function getDeliveryVariantId(): int
    {
        return $this->deliveryVariantId;
    }

    /**
     * @param int $deliveryVariantId
     * @return DeliveryCalculate
     */
    public function setDeliveryVariantId(int $deliveryVariantId): DeliveryCalculate
    {
        $this->deliveryVariantId = $deliveryVariantId;
        return $this;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     * @return DeliveryCalculate
     */
    public function setWeight(float $weight): DeliveryCalculate
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return int
     */
    public function getFromPlaceId(): int
    {
        return $this->fromPlaceId;
    }

    /**
     * @param int $fromPlaceId
     * @return DeliveryCalculate
     */
    public function setFromPlaceId(int $fromPlaceId): DeliveryCalculate
    {
        $this->fromPlaceId = $fromPlaceId;
        return $this;
    }

    /**
     * @return float
     */
    public function getEstimatedPrice(): float
    {
        return $this->estimatedPrice;
    }

    /**
     * @param float $estimatedPrice
     * @return DeliveryCalculate
     */
    public function setEstimatedPrice(float $estimatedPrice): DeliveryCalculate
    {
        $this->estimatedPrice = $estimatedPrice;
        return $this;
    }
}