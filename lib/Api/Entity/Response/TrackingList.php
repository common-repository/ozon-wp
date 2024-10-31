<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\TrackingList\ItemList;

/**
 * Class TrackingList
 * @package Ipol\Ozon\Api\Entity\Response
 */
class TrackingList extends AbstractResponse
{
    /**
     * @var ItemList
     */
    protected $items;

    /**
     * @return ItemList
     */
    public function getItems(): ItemList
    {
        return $this->items;
    }

    /**
     * @param array $array
     * @return TrackingList
     * @throws BadResponseException
     */
    public function setItems(array $array): TrackingList
    {
        $collection = new ItemList();
        $this->items = $collection->fillFromArray($array);
        return $this;
    }

}