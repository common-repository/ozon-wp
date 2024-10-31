<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo;

use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;


/**
 * Class Line
 * @package Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo
 */
class Line extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var int
     */
    protected $id;
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
     * @return Line
     */
    public function setId(int $id): Line
    {
        $this->id = $id;
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
     * @return Line
     */
    public function setName(string $name): Line
    {
        $this->name = $name;
        return $this;
    }

}