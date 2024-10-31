<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\DocumentList;


use Ipol\Ozon\Api\Entity\AbstractCollection;

class DataList extends AbstractCollection
{
    protected $Datas;

    public function __construct()
    {
        parent::__construct('Datas');
    }

    /**
     * @return Data
     */
    public function getFirst(){
        return parent::getFirst();
    }

    /**
     * @return Data
     */
    public function getNext(){
        return parent::getNext();
    }
}