<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\TrackingList;


use Ipol\Ozon\Api\Entity\AbstractCollection;

class EventList extends AbstractCollection
{
    protected $Events;

    public function __construct()
    {
        parent::__construct('Events');
    }

    /**
     * @return Event
     */
    public function getFirst(){
        return parent::getFirst();
    }

    /**
     * @return Event
     */
    public function getNext(){
        return parent::getNext();
    }
}