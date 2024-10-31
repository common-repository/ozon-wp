<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo;

use Ipol\Ozon\Api\Entity\AbstractCollection;


class MetroStationList extends AbstractCollection
{
    protected $MetroStations;

    public function __construct()
    {
        parent::__construct('MetroStations');
    }

    /**
     * @return MetroStation
     */
    public function getFirst(){
        return parent::getFirst();
    }

    /**
     * @return MetroStation
     */
    public function getNext(){
        return parent::getNext();
    }
}