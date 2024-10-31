<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\ReportList;


use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Item
 * @package Ipol\Ozon\Api\Entity\Response\Part\ReportList
 */
class Item extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $number;
    /**
     * @var string
     */
    protected $date;
    /**
     * @var string
     */
    protected $stateName;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Item
     */
    public function setId(string $id): Item
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Item
     */
    public function setNumber(string $number): Item
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return Item
     */
    public function setDate(string $date): Item
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getStateName(): string
    {
        return $this->stateName;
    }

    /**
     * @param string $stateName
     * @return Item
     */
    public function setStateName(string $stateName): Item
    {
        $this->stateName = $stateName;
        return $this;
    }

}