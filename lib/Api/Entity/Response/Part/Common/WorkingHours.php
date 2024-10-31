<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\Common;

use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;


/**
 * Class WorkingHours
 * @package Ipol\Ozon\Api\Entity\Response\Part\Common
 */
class WorkingHours extends AbstractEntity
{
    use AbstractResponsePart;
    /**
     * @var string (DateTime)
     */
    protected $date;
    /**
     * @var PeriodList
     */
    protected $periods;

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return WorkingHours
     */
    public function setDate(string $date): WorkingHours
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return PeriodList
     */
    public function getPeriods(): PeriodList
    {
        return $this->periods;
    }

    /**
     * @param array $array
     * @return WorkingHours
     * @throws BadResponseException
     */
    public function setPeriods(array $array): WorkingHours
    {
        $collection = new PeriodList();
        $this->periods = $collection->fillFromArray($array);
        return $this;
    }


}