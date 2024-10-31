<?php


namespace Ipol\Ozon\Api\Entity\Request;


use Ipol\Ozon\Api\Entity\Request\Part\Common\PackageList;

/**
 * Class DeliveryVariantsByAddress
 * @package Ipol\Ozon\Api\Entity\Request
 */
class DeliveryVariantsByAddress extends AbstractRequest
{
    /**
     * @var string
     */
    protected $deliveryType;
    /**
     * @var string
     */
    protected $address;
    /**
     * @var float
     */
    protected $radius;
    /**
     * @var PackageList
     */
    protected $packages;

    /**
     * @return string
     */
    public function getDeliveryType(): string
    {
        return $this->deliveryType;
    }

    /**
     * @param string $deliveryType
     * @return DeliveryVariantsByAddress
     */
    public function setDeliveryType(string $deliveryType): DeliveryVariantsByAddress
    {
        $this->deliveryType = $deliveryType;
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
     * @return DeliveryVariantsByAddress
     */
    public function setAddress(string $address): DeliveryVariantsByAddress
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getRadius(): float
    {
        return $this->radius;
    }

    /**
     * @param float|null $radius
     * @return DeliveryVariantsByAddress
     */
    public function setRadius(float $radius): DeliveryVariantsByAddress
    {
        $this->radius = $radius;
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
     * @param \Ipol\Ozon\Api\Entity\Request\Part\Common\PackageList $packages
     * @return DeliveryVariantsByAddress
     */
    public function setPackages(PackageList $packages): DeliveryVariantsByAddress
    {
        $this->packages = $packages;
        return $this;
    }

}