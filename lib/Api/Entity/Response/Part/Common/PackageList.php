<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\Common;


use Ipol\Ozon\Api\Entity\AbstractCollection;

class PackageList extends AbstractCollection
{
    protected $Packages;

    public function __construct()
    {
        parent::__construct('Packages');
    }

    /**
     * @return Package
     */
    public function getFirst(){
        return parent::getFirst();
    }

    /**
     * @return Package
     */
    public function getNext(){
        return parent::getNext();
    }
}