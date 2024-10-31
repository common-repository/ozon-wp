<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\DocumentReturnDocuments;


use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Item
 * @package Ipol\Ozon\Api\Entity\Response\Part\DocumentReturnDocuments
 */
class Item extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var string
     */
    protected $documentID;
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
    protected $stateTransitID;
    /**
     * @var string
     */
    protected $stateTransitName;
    /**
     * @var string
     */
    protected $pickupPlaceID;
    /**
     * @var string
     */
    protected $pickupPlaceName;
    /**
     * @var string
     */
    protected $storage;

    /**
     * @return string
     */
    public function getDocumentID(): string
    {
        return $this->documentID;
    }

    /**
     * @param string $documentID
     * @return Item
     */
    public function setDocumentID(string $documentID): Item
    {
        $this->documentID = $documentID;
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
    public function getStateTransitID(): string
    {
        return $this->stateTransitID;
    }

    /**
     * @param string $stateTransitID
     * @return Item
     */
    public function setStateTransitID(string $stateTransitID): Item
    {
        $this->stateTransitID = $stateTransitID;
        return $this;
    }

    /**
     * @return string
     */
    public function getStateTransitName(): string
    {
        return $this->stateTransitName;
    }

    /**
     * @param string $stateTransitName
     * @return Item
     */
    public function setStateTransitName(string $stateTransitName): Item
    {
        $this->stateTransitName = $stateTransitName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPickupPlaceID(): string
    {
        return $this->pickupPlaceID;
    }

    /**
     * @param string $pickupPlaceID
     * @return Item
     */
    public function setPickupPlaceID(string $pickupPlaceID): Item
    {
        $this->pickupPlaceID = $pickupPlaceID;
        return $this;
    }

    /**
     * @return string
     */
    public function getPickupPlaceName(): string
    {
        return $this->pickupPlaceName;
    }

    /**
     * @param string $pickupPlaceName
     * @return Item
     */
    public function setPickupPlaceName(string $pickupPlaceName): Item
    {
        $this->pickupPlaceName = $pickupPlaceName;
        return $this;
    }

    /**
     * @return string
     */
    public function getStorage(): string
    {
        return $this->storage;
    }

    /**
     * @param string $storage
     * @return Item
     */
    public function setStorage(string $storage): Item
    {
        $this->storage = $storage;
        return $this;
    }

}