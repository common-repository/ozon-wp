<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\OrderImport\OrderList;

/**
 * Class OrderImport
 * @package Ipol\Ozon\Api\Entity\Response
 */
class OrderImport extends AbstractResponse
{
    /**
     * @var OrderList
     */
    protected $orders;

    /**
     * @return OrderList
     */
    public function getOrders(): OrderList
    {
        return $this->orders;
    }

    /**
     * @param array $array
     * @return OrderImport
     * @throws BadResponseException
     */
    public function setOrders(array $array): OrderImport
    {
        $collection = new OrderList();
        $this->orders = $collection->fillFromArray($array);
        return $this;
    }

}