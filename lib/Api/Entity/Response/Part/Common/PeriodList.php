<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\Common;


use Ipol\Ozon\Api\Entity\AbstractCollection;

class PeriodList extends AbstractCollection
{
    protected $Periods;

    public function __construct()
    {
        parent::__construct('Periods');
    }

    /**
     * @return Period
     */
    public function getFirst(){
        return parent::getFirst();
    }

    /**
     * @return Period
     */
    public function getNext(){
        return parent::getNext();
    }
}