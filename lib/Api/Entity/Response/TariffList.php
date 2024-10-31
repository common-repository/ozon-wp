<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\TariffList\ItemList;

/**
 * Class TariffList
 * @package Ipol\Ozon\Api\Entity\Response
 */
class TariffList extends AbstractResponse
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
     * @return TariffList
     * @throws BadResponseException
     */
    public function setItems(array $array): TariffList
    {
            $collection = new ItemList();
            $this->items = $collection->fillFromArray($array);
            return $this;
    }

}