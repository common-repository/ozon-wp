<?php


namespace Ipol\Ozon\Api\Entity\Request;


use Ipol\Ozon\Api\Entity\Request\Part\DeliveryVariantsByViewport\ViewPort;
use Ipol\Ozon\Api\Entity\Request\Part\Order\PackageList;

/**
 * Class DeliveryVariantsByViewport
 * @package Ipol\Ozon\Api\Entity\Request
 */
class DeliveryVariantsByViewport extends AbstractRequest
{
    /**
     * @var string[]  - "Courier" | "Postamat" | "Pickup" any combination from one to all at once
     */
    protected $deliveryTypes;
    /**
     * @var ViewPort
     */
    protected $viewPort;
    /**
     * @var PackageList
     */
    protected $packages;

    /**
     * @return string[]
     */
    public function getDeliveryTypes(): array
    {
        return $this->deliveryTypes;
    }

    /**
     * @param string[] $deliveryTypes
     * @return DeliveryVariantsByViewport
     */
    public function setDeliveryTypes(array $deliveryTypes): DeliveryVariantsByViewport
    {
        $this->deliveryTypes = $deliveryTypes;
        return $this;
    }

    /**
     * @return ViewPort
     */
    public function getViewPort(): ViewPort
    {
        return $this->viewPort;
    }

    /**
     * @param ViewPort $viewPort
     * @return DeliveryVariantsByViewport
     */
    public function setViewPort(ViewPort $viewPort): DeliveryVariantsByViewport
    {
        $this->viewPort = $viewPort;
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
     * @return DeliveryVariantsByViewport
     */
    public function setPackages(PackageList $packages): DeliveryVariantsByViewport
    {
        $this->packages = $packages;
        return $this;
    }

}