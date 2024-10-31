<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\OrderImport;


use Ipol\Ozon\Api\Entity\AbstractCollection;

class OrderList extends AbstractCollection
{
    protected $Orders;

    public function __construct()
    {
        parent::__construct('Orders');
    }

    /**
     * @return Order
     */
    public function getFirst(){
        return parent::getFirst();
    }

    /**
     * @return Order
     */
    public function getNext(){
        return parent::getNext();
    }
}