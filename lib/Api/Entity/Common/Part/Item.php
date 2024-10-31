<?php


namespace Ipol\Ozon\Api\Entity\Common\Part;


use Ipol\Ozon\Api\Entity\AbstractEntity;

/**
 * Class Item
 * @package Ipol\Ozon\Api
 * @subpackage Entity
 */
class Item extends AbstractEntity
{
    /**
     * @var integer
     */
    protected $eventId;
    /**
     * @var integer
     */
    protected $placeId;
    /**
     * @var string
     */
    protected $placeName;
    /**
     * @var string (DateTime)
     */
    protected $moment;
    /**
     * @var string
     */
    protected $action;
    /**
     * @var integer
     */
    protected $carrierId;
    /**
     * @var string
     */
    protected $carrierName;

    /**
     * @return int
     */
    public function getEventId(): int
    {
        return $this->eventId;
    }

    /**
     * @param int $eventId
     * @return Item
     */
    public function setEventId(int $eventId)
    {
        $this->eventId = $eventId;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlaceId(): int
    {
        return $this->placeId;
    }

    /**
     * @param int $placeId
     * @return Item
     */
    public function setPlaceId(int $placeId)
    {
        $this->placeId = $placeId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlaceName(): string
    {
        return $this->placeName;
    }

    /**
     * @param string $placeName
     * @return Item
     */
    public function setPlaceName(string $placeName)
    {
        $this->placeName = $placeName;
        return $this;
    }

    /**
     * @return string
     */
    public function getMoment(): string
    {
        return $this->moment;
    }

    /**
     * @param string $moment
     * @return Item
     */
    public function setMoment(string $moment)
    {
        $this->moment = $moment;
        return $this;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     * @return Item
     */
    public function setAction(string $action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return int
     */
    public function getCarrierId(): int
    {
        return $this->carrierId;
    }

    /**
     * @param int $carrierId
     * @return Item
     */
    public function setCarrierId(int $carrierId)
    {
        $this->carrierId = $carrierId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCarrierName(): string
    {
        return $this->carrierName;
    }

    /**
     * @param string $carrierName
     * @return Item
     */
    public function setCarrierName(string $carrierName)
    {
        $this->carrierName = $carrierName;
        return $this;
    }

}