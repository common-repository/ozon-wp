<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\Common;

use Ipol\Ozon\Api\Entity\AbstractCollection;


class DataList extends AbstractCollection
{
    protected $Datas;

    public function __construct()
    {
        parent::__construct('Datas');
        $this->setChildClass(Data::class);
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