<?php


namespace Ipol\Ozon\Api\Entity\Request\Part\Common;

use Ipol\Ozon\Api\Entity\AbstractEntity;


/**
 * Class Dimensions
 * @package Ipol\Ozon\Api\Entity\Request\Part\Common
 */
class Dimensions extends AbstractEntity
{
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
     * Dimensions constructor.
     * @param int $weight
     * @param int $length
     * @param int $height
     * @param int $width
     */
    public function __construct(int $weight, int $length, int $width, int $height)
    {
        parent::__construct();
        $this->weight = $weight;
        $this->length = $length;
        $this->height = $height;
        $this->width = $width;
    }

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