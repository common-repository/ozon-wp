<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\Common;

use Ipol\Ozon\Api\Entity\AbstractCollection;


class WorkingHoursList extends AbstractCollection
{
    protected $WorkingHourses;

    public function __construct()
    {
        parent::__construct('WorkingHourses');
        $this->setChildClass(WorkingHours::class);
    }

    /**
     * @return WorkingHours
     */
    public function getFirst(){
        return parent::getFirst();
    }

    /**
     * @return WorkingHours
     */
    public function getNext(){
        return parent::getNext();
    }
}