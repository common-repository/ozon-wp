<?php


namespace Ipol\Ozon\Api\Entity\Request\Part\DeliveryVariantsByViewport;


use Ipol\Ozon\Api\Entity\AbstractEntity;

/**
 * Class Coordinates
 * @package Ipol\Ozon\Api\Entity\Request\Part\DeliveryVariantsByViewport
 */
class Coordinates extends AbstractEntity
{
    /**
     * @var float
     */
    protected $longitude;
    /**
     * @var float
     */
    protected $latitude;

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     * @return Coordinates
     */
    public function setLongitude(float $longitude): Coordinates
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     * @return Coordinates
     */
    public function setLatitude(float $latitude): Coordinates
    {
        $this->latitude = $latitude;
        return $this;
    }

}