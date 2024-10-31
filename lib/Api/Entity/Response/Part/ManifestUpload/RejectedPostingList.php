<?php


namespace Ipol\Ozon\Api\Entity\Response\Part;


class RejectedPostingList extends \Ipol\Ozon\Api\Entity\AbstractCollection
{
    protected $RejectedPostings;

    public function __construct()
    {
        parent::__construct('RejectedPostings');
    }

    /**
     * @return RejectedPosting
     */
    public function getFirst(){
        return parent::getFirst();
    }

    /**
     * @return RejectedPosting
     */
    public function getNext(){
        return parent::getNext();
    }
}