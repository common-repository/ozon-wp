<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo;

use Ipol\Ozon\Api\Entity\AbstractCollection;


class PropertyList extends AbstractCollection
{
    protected $Properties;

    public function __construct()
    {
        parent::__construct('Properties');
        $this->setChildClass(Property::class);
    }

    /**
     * @return Property
     */
    public function getFirst(){
        return parent::getFirst();
    }

    /**
     * @return Property
     */
    public function getNext(){
        return parent::getNext();
    }
}