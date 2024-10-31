<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo;

use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;


/**
 * Class Coordinates
 * @package Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo
 */
class Coordinates extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var float
     */
    protected $lat;
    /**
     * @var float
     */
    protected $long;

    /**
     * @return float
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     * @return Coordinates
     */
    public function setLat(float $lat): Coordinates
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return float
     */
    public function getLong(): float
    {
        return $this->long;
    }

    /**
     * @param float $long
     * @return Coordinates
     */
    public function setLong(float $long): Coordinates
    {
        $this->long = $long;
        return $this;
    }

}