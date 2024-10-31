<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\TrackingByPostingNumber;


use Ipol\Ozon\Api\Entity\AbstractCollection;

class ItemList extends AbstractCollection
{
    protected $Items;

    public function __construct()
    {
        parent::__construct('Items');
    }

    /**
     * @return Item
     */
    public function getFirst(){
        return parent::getFirst();
    }

    /**
     * @return Item
     */
    public function getNext(){
        return parent::getNext();
    }
}