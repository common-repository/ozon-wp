<?php


namespace Ipol\Ozon\Api\Entity\Request\Part\Order;


use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Request\Part\Common\Dimensions;

/**
 * Class Package
 * @package Ipol\Ozon\Api\Entity\Request\Part\Order
 */
class Package extends AbstractEntity
{
    /**
     * @var string
     */
    protected $packageNumber;
    /**
     * @var Dimensions
     */
    protected $dimensions;
    /**
     * @var string
     */
    protected $barCode;

    /**
     * @return string
     */
    public function getPackageNumber(): string
    {
        return $this->packageNumber;
    }

    /**
     * @param string $packageNumber
     * @return Package
     */
    public function setPackageNumber(string $packageNumber): Package
    {
        $this->packageNumber = $packageNumber;
        return $this;
    }

    /**
     * @return Dimensions
     */
    public function getDimensions(): Dimensions
    {
        return $this->dimensions;
    }

    /**
     * @param Dimensions $dimensions
     * @return Package
     */
    public function setDimensions(Dimensions $dimensions): Package
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    /**
     * @return string
     */
    public function getBarCode(): ?string
    {
        return $this->barCode;
    }

    /**
     * @param string $barCode
     * @return Package
     */
    public function setBarCode(string $barCode): Package
    {
        $this->barCode = $barCode;
        return $this;
    }

}