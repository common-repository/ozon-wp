<?php


namespace Ipol\Ozon\Api\Entity\Request\Part\Common;

use Ipol\Ozon\Api\Entity\AbstractEntity;


/**
 * Class Package
 * @package Ipol\Ozon\Api\Entity\Request\Part\Common
 */
class Package extends AbstractEntity
{
    /**
     * @var int
     */
    protected $count;
    /**
     * @var Dimensions
     */
    protected $dimensions;
    /**
     * @var float
     */
    protected $price;

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return Package
     */
    public function setCount(int $count): Package
    {
        $this->count = $count;
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
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Package
     */
    public function setPrice(float $price): Package
    {
        $this->price = $price;
        return $this;
    }

}