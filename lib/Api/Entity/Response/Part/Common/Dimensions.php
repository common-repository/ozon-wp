<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\Common;

use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;


/**
 * Class Dimensions
 * @package Ipol\Ozon\Api
 */
class Dimensions extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var int
     */
    protected $weight;
    /**
     * @var int
     */
    protected $length;
    /**
     * @var int
     */
    protected $height;
    /**
     * @var int
     */
    protected $width;

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return Dimensions
     */
    public function setWeight(int $weight): Dimensions
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     * @return Dimensions
     */
    public function setLength(int $length): Dimensions
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return Dimensions
     */
    public function setHeight(int $height): Dimensions
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return Dimensions
     */
    public function setWidth(int $width): Dimensions
    {
        $this->width = $width;
        return $this;
    }

}