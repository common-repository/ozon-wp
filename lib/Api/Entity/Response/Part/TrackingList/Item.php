<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\TrackingList;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Item
 * @package Ipol\Ozon\Api\Entity\Response\Part\TrackingList
 */
class Item extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var string
     */
    protected $postingNumber;
    /**
     * @var string
     */
    protected $postingBarcode;
    /**
     * @var int
     */
    protected $postingId;
    /**
     * @var EventList
     */
    protected $events;
    /**
     * @return string
     */
    public function getPostingNumber(): string
    {
        return $this->postingNumber;
    }

    /**
     * @param string $postingNumber
     * @return Item
     */
    public function setPostingNumber(string $postingNumber): Item
    {
        $this->postingNumber = $postingNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostingBarcode(): string
    {
        return $this->postingBarcode;
    }

    /**
     * @param string $postingBarcode
     * @return Item
     */
    public function setPostingBarcode(string $postingBarcode): Item
    {
        $this->postingBarcode = $postingBarcode;
        return $this;
    }

    /**
     * @return int
     */
    public function getPostingId(): ?int
    {
        return $this->postingId;
    }

    /**
     * @param int $postingId
     * @return Item
     */
    public function setPostingId(string $postingId): Item
    {
        $this->postingId = $postingId;
        return $this;
    }

    /**
     * @return EventList
     */
    public function getEvents(): ?EventList
    {
        return $this->events;
    }

    /**
     * @param array $array
     * @return Item
     * @throws BadResponseException
     */
    public function setEvents(array $array): Item
    {
        $collection = new EventList();
        $this->events = $collection->fillFromArray($array);
        return $this;
    }

}