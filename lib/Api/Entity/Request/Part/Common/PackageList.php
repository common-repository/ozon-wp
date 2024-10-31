<?php


namespace Ipol\Ozon\Api\Entity\Request\Part\Common;

use Ipol\Ozon\Api\Entity\AbstractCollection;


class PackageList extends AbstractCollection
{
    protected $packages;

    public function __construct()
    {
        parent::__construct('packages');
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