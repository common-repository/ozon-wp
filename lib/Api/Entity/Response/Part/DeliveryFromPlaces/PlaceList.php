<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\DeliveryFromPlaces;


use Ipol\Ozon\Api\Entity\AbstractCollection;

class PlaceList extends AbstractCollection
{
    protected $Places;

    public function __construct()
    {
        parent::__construct('Places');
    }

    /**
     * @return Place
     */
    public function getFirst(){
        return parent::getFirst();
    }

    /**
     * @return Place
     */
    public function getNext(){
        return parent::getNext();
    }
}