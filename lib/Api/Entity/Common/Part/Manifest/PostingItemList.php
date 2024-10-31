<?php


namespace Ipol\Ozon\Api\Entity\Common\Part\Manifest;


use Ipol\Ozon\Api\Entity\AbstractCollection;

class PostingItemList extends AbstractCollection
{
    protected $PostingItems;

    public function __construct()
    {
        parent::__construct('PostingItems');
    }

    /**
     * @return PostingItem
     */
    public function getFirst(){
        return parent::getFirst();
    }

    /**
     * @return PostingItem
     */
    public function getNext(){
        return parent::getNext();
    }
}