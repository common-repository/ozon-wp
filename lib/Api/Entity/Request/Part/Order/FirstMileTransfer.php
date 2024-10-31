<?php


namespace Ipol\Ozon\Api\Entity\Request\Part\Order;


use Ipol\Ozon\Api\Entity\AbstractEntity;

/**
 * Class FirstMileTransfer
 * @package Ipol\Ozon\Api\Entity\Request\Part\Order
 */
class FirstMileTransfer extends AbstractEntity
{
    /**
     * @var string ("DropOff")
     */
    protected $type = "DropOff";
    /**
     * @var string
     */
    protected $fromPlaceId;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return FirstMileTransfer
     */
    public function setType(string $type): FirstMileTransfer
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getFromPlaceId(): string
    {
        return $this->fromPlaceId;
    }

    /**
     * @param string $fromPlaceId
     * @return FirstMileTransfer
     */
    public function setFromPlaceId(string $fromPlaceId): FirstMileTransfer
    {
        $this->fromPlaceId = $fromPlaceId;
        return $this;
    }


}