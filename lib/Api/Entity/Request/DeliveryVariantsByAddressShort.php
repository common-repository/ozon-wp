<?php


namespace Ipol\Ozon\Api\Entity\Request;


use Ipol\Ozon\Api\Entity\Request\Part\Common\PackageList;

/**
 * Class DeliveryVariantsByAddressShort
 * @package Ipol\Ozon\Api\Entity\Request
 */
class DeliveryVariantsByAddressShort extends AbstractRequest
{
    /**
     * @var string[] - "Courier" | "PickPoint" | "Pickup" any combination from one to all at once
     */
    protected $deliveryTypes;
    /**
     * @var string
     */
    protected $address;
    /**
     * @var PackageList
     */
    protected $packages;
    /**
     * @var float - km
     */
    protected $radius;
    /**
     * @var int
     */
    protected $limit = 3000;

    /**
     * @return string[]
     */
    public function getDeliveryTypes(): array
    {
        return $this->deliveryTypes;
    }

    /**
     * @param string[] $deliveryTypes
     * @return DeliveryVariantsByAddressShort
     */
    public function setDeliveryTypes(array $deliveryTypes): DeliveryVariantsByAddressShort
    {
        $this->deliveryTypes = $deliveryTypes;
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
     * @return DeliveryVariantsByAddressShort
     */
    public function setAddress(string $address): DeliveryVariantsByAddressShort
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return PackageList
     */
    public function getPackages(): PackageList
    {
        return $this->packages;
    }

    /**
     * @param PackageList $packages
     * @return DeliveryVariantsByAddressShort
     */
    public function setPackages(PackageList $packages): DeliveryVariantsByAddressShort
    {
        $this->packages = $packages;
        return $this;
    }

    /**
     * @return float
     */
    public function getRadius(): float
    {
        return $this->radius;
    }

    /**
     * @param float $radius
     * @return DeliveryVariantsByAddressShort
     */
    public function setRadius(float $radius): DeliveryVariantsByAddressShort
    {
        $this->radius = $radius;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return DeliveryVariantsByAddressShort
     */
    public function setLimit(int $limit): DeliveryVariantsByAddressShort
    {
        $this->limit = $limit;
        return $this;
    }
    
}