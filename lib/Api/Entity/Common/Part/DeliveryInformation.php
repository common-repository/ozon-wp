<?php


namespace Ipol\Ozon\Api\Entity\Common\Part;


use Ipol\Ozon\Api\Entity\AbstractEntity;

/**
 * Class DeliveryInformation
 * @package Ipol\Ozon\Api
 * @subpackage Entity
 */
class DeliveryInformation extends AbstractEntity
{
    /**
     * @var string
     */
    protected $deliveryVariantId;
    /**
     * @var string
     */
    protected $address;
    /**
     * @var string
     */
    protected $timeSlotId;

    /**
     * @return string
     */
    public function getDeliveryVariantId(): string
    {
        return $this->deliveryVariantId;
    }

    /**
     * @param string $deliveryVariantId
     * @return DeliveryInformation
     */
    public function setDeliveryVariantId(string $deliveryVariantId)
    {
        $this->deliveryVariantId = $deliveryVariantId;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return DeliveryInformation
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimeSlotId(): ?string
    {
        return $this->timeSlotId;
    }

    /**
     * @param string $timeSlotId
     * @return DeliveryInformation
     */
    public function setTimeSlotId(string $timeSlotId)
    {
        $this->timeSlotId = $timeSlotId;
        return $this;
    }
}