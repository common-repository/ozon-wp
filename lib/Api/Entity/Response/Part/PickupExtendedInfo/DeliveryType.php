<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo;

use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;


/**
 * Class DeliveryType
 * @package Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo
 */
class DeliveryType extends AbstractEntity
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
     * @return DeliveryType
     */
    public function setId(int $id): DeliveryType
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
     * @return DeliveryType
     */
    public function setName(string $name): DeliveryType
    {
        $this->name = $name;
        return $this;
    }

}