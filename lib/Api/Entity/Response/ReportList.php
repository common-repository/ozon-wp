<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\ReportList\ItemList;

/**
 * Class ReportList
 * @package Ipol\Ozon\Api\Entity\Response
 */
class ReportList extends AbstractResponse
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
     * @return ReportList
     * @throws BadResponseException
     */
    public function setItems(array $array): ReportList
    {
        $collection = new ItemList();
        $this->items = $collection->fillFromArray($array);
        return $this;
    }

}