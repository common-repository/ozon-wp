<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\DeliveryFromPlaces\PlaceList;

/**
 * Class DeliveryFromPlaces
 * @package Ipol\Ozon\Api\Entity\Response
 */
class DeliveryFromPlaces extends AbstractResponse
{
    /**
     * @var PlaceList
     */
    protected $places;

    /**
     * @return PlaceList
     */
    public function getPlaces(): PlaceList
    {
        return $this->places;
    }

    /**
     * @param array $array
     * @return DeliveryFromPlaces
     * @throws BadResponseException
     */
    public function setPlaces(array $array): DeliveryFromPlaces
    {
        $collection = new PlaceList();
        $this->places = $collection->fillFromArray($array);
        return $this;

    }

}