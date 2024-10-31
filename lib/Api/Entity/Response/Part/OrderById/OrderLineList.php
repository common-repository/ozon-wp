<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\OrderById;


use Ipol\Ozon\Api\Entity\AbstractCollection;

class OrderLineList extends AbstractCollection
{
    protected $OrderLines;

    public function __construct()
    {
        parent::__construct('OrderLines');
    }

    /**
     * @return OrderLine
     */
    public function getFirst(){
        return parent::getFirst();
    }

    /**
     * @return OrderLine
     */
    public function getNext(){
        return parent::getNext();
    }
}