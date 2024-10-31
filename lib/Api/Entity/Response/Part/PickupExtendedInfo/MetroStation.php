<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo;

use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;


/**
 * Class MetroStation
 * @package Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo
 */
class MetroStation extends AbstractEntity
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
     * @var Line
     */
    protected $line;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return MetroStation
     */
    public function setId(int $id): MetroStation
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
     * @return MetroStation
     */
    public function setName(string $name): MetroStation
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Line
     */
    public function getLine(): Line
    {
        return $this->line;
    }

    /**
     * @param array $line
     * @return MetroStation
     */
    public function setLine(array $line): MetroStation
    {
        $this->line = new Line($line);
        return $this;
    }
}