<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\OrderById;


use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class DeliveryInformation
 * @package Ipol\Ozon\Api\Entity\Response\Part\OrderById
 */
class DeliveryInformation extends \Ipol\Ozon\Api\Entity\Common\Part\DeliveryInformation
{
    use AbstractResponsePart;

    /**
     * @var string
     */
    protected $deliveryVariantTypeId;
    /**
     * @var string
     */
    protected $deliveryType;
    /**
     * @var DesiredDeliveryTimeInterval|null
     */
    protected $desiredDeliveryTimeInterval;

    /**
     * @return string
     */
    public function getDeliveryType(): string
    {
        return $this->deliveryType;
    }

    /**
     * @param string $deliveryType
     * @return DeliveryInformation
     */
    public function setDeliveryType(string $deliveryType): DeliveryInformation
    {
        $this->deliveryType = $deliveryType;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryVariantTypeId(): string
    {
        return $this->deliveryVariantTypeId;
    }

    /**
     * @param string $deliveryVariantTypeId
     * @return DeliveryInformation
     */
    public function setDeliveryVariantTypeId(string $deliveryVariantTypeId): DeliveryInformation
    {
        $this->deliveryVariantTypeId = $deliveryVariantTypeId;
        return $this;
    }

    /**
     * @return DesiredDeliveryTimeInterval|null
     */
    public function getDesiredDeliveryTimeInterval(): ?DesiredDeliveryTimeInterval
    {
        return $this->desiredDeliveryTimeInterval;
    }

    /**
     * @param DesiredDeliveryTimeInterval|null $desiredDeliveryTimeInterval
     * @return DeliveryInformation
     */
    public function setDesiredDeliveryTimeInterval(?DesiredDeliveryTimeInterval $desiredDeliveryTimeInterval): DeliveryInformation
    {
        $this->desiredDeliveryTimeInterval = $desiredDeliveryTimeInterval;
        return $this;
    }

    /**
     * @param string $deliveryVariantId
     * @return DeliveryInformation
     */
    public function setDeliveryVariantId(string $deliveryVariantId): DeliveryInformation
    {
        $this->deliveryVariantId = $deliveryVariantId;
        return $this;
    }

    /**
     * @param string $address
     * @return DeliveryInformation
     */
    public function setAddress(string $address): DeliveryInformation
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param string $timeSlotId
     * @return DeliveryInformation
     */
    public function setTimeSlotId(string $timeSlotId): DeliveryInformation
    {
        $this->timeSlotId = $timeSlotId;
        return $this;
    }

}