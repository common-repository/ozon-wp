<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\DocumentList;

use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Data
 * @package Ipol\Ozon\Api\Entity\Response\Part\DocumentList
 */
class Data extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $number;
    /**
     * @var string (DateTime "2021-03-05T15:25:04.835Z")
     */
    protected $date;
    /**
     * @var string
     */
    protected $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Data
     */
    public function setId(int $id): Data
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
     * @return Data
     */
    public function setNumber(string $number): Data
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
     * @return Data
     */
    public function setDate(string $date): Data
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Data
     */
    public function setName(string $name): Data
    {
        $this->name = $name;
        return $this;
    }

}