<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\TrackingPosting\ItemList;

/**
 * Class TrackingPosting
 * @package Ipol\Ozon\Api\Entity\Response
 */
class TrackingPosting extends AbstractResponse
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $postingNumber;
    /**
     * @var string
     */
    protected $postingBarcode;
    /**
     * @var string
     */
    protected $articleType;
    /**
     * @var string
     */
    protected $deliveryVariantType;
    /**
     * @var string
     */
    protected $deliveryVariantName;
    /**
     * @var bool
     */
    protected $isDangerous;
    /**
     * @var float
     */
    protected $clientPrice;
    /**
     * @var float
     */
    protected $itemPrice;
    /**
     * @var float
     */
    protected $deliveryPrice;
    /**
     * @var int
     */
    protected $weight;
    /**
     * @var int
     */
    protected $volumeWeight;
    /**
     * @var int
     */
    protected $length;
    /**
     * @var int
     */
    protected $width;
    /**
     * @var int
     */
    protected $height;
    /**
     * @var string
     */
    protected $deliveryAddress;
    /**
     * @var string
     */
    protected $recipient;
    /**
     * @var bool
     */
    protected $isCompany;
    /**
     * @var string
     */
    protected $storage;
    /**
     * @var int
     */
    protected $storageTime;
    /**
     * @var string
     */
    protected $comment;
    /**
     * @var string
     */
    protected $phone;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $carriageBarcode;
    /**
     * @var string
     */
    protected $extractPointCode;
    /**
     * @var bool
     */
    protected $isReturn;
    /**
     * @var int
     */
    protected $pickupPlaceId;
    /**
     * @var string
     */
    protected $pickupPlaceName;
    /**
     * @var string
     */
    protected $pickupPlaceAddress;
    /**
     * @var string
     */
    protected $addressee;
    /**
     * @var string (DateTime)
     */
    protected $storageExpirationDate;
    /**
     * @var string (DateTime)
     */
    protected $externalDeliveryDateTimeFrom;
    /**
     * @var string (DateTime)
     */
    protected $externalDeliveryDateTimeTo;
    /**
     * @var string (DateTime)
     */
    protected $currentDeliveryDateTimeFrom;
    /**
     * @var string (DateTime)
     */
    protected $currentDeliveryDateTimeTo;
    /**
     * @var ItemList
     */
    protected $items;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return TrackingPosting
     */
    public function setId(int $id): TrackingPosting
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostingNumber(): string
    {
        return $this->postingNumber;
    }

    /**
     * @param string $postingNumber
     * @return TrackingPosting
     */
    public function setPostingNumber(string $postingNumber): TrackingPosting
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
     * @return TrackingPosting
     */
    public function setPostingBarcode(string $postingBarcode): TrackingPosting
    {
        $this->postingBarcode = $postingBarcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getArticleType(): string
    {
        return $this->articleType;
    }

    /**
     * @param string $articleType
     * @return TrackingPosting
     */
    public function setArticleType(string $articleType): TrackingPosting
    {
        $this->articleType = $articleType;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryVariantType(): string
    {
        return $this->deliveryVariantType;
    }

    /**
     * @param string $deliveryVariantType
     * @return TrackingPosting
     */
    public function setDeliveryVariantType(string $deliveryVariantType): TrackingPosting
    {
        $this->deliveryVariantType = $deliveryVariantType;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryVariantName(): string
    {
        return $this->deliveryVariantName;
    }

    /**
     * @param string $deliveryVariantName
     * @return TrackingPosting
     */
    public function setDeliveryVariantName(string $deliveryVariantName): TrackingPosting
    {
        $this->deliveryVariantName = $deliveryVariantName;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsDangerous(): bool
    {
        return $this->isDangerous;
    }

    /**
     * @param bool $isDangerous
     * @return TrackingPosting
     */
    public function setIsDangerous(bool $isDangerous): TrackingPosting
    {
        $this->isDangerous = $isDangerous;
        return $this;
    }

    /**
     * @return float
     */
    public function getClientPrice(): float
    {
        return $this->clientPrice;
    }

    /**
     * @param float $clientPrice
     * @return TrackingPosting
     */
    public function setClientPrice(float $clientPrice): TrackingPosting
    {
        $this->clientPrice = $clientPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getItemPrice(): float
    {
        return $this->itemPrice;
    }

    /**
     * @param float $itemPrice
     * @return TrackingPosting
     */
    public function setItemPrice(float $itemPrice): TrackingPosting
    {
        $this->itemPrice = $itemPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getDeliveryPrice(): float
    {
        return $this->deliveryPrice;
    }

    /**
     * @param float $deliveryPrice
     * @return TrackingPosting
     */
    public function setDeliveryPrice(float $deliveryPrice): TrackingPosting
    {
        $this->deliveryPrice = $deliveryPrice;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return TrackingPosting
     */
    public function setWeight(int $weight): TrackingPosting
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return int
     */
    public function getVolumeWeight(): int
    {
        return $this->volumeWeight;
    }

    /**
     * @param int $volumeWeight
     * @return TrackingPosting
     */
    public function setVolumeWeight(int $volumeWeight): TrackingPosting
    {
        $this->volumeWeight = $volumeWeight;
        return $this;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     * @return TrackingPosting
     */
    public function setLength(int $length): TrackingPosting
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return TrackingPosting
     */
    public function setWidth(int $width): TrackingPosting
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return TrackingPosting
     */
    public function setHeight(int $height): TrackingPosting
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryAddress(): string
    {
        return $this->deliveryAddress;
    }

    /**
     * @param string $deliveryAddress
     * @return TrackingPosting
     */
    public function setDeliveryAddress(string $deliveryAddress): TrackingPosting
    {
        $this->deliveryAddress = $deliveryAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipient(): string
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     * @return TrackingPosting
     */
    public function setRecipient(string $recipient): TrackingPosting
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsCompany(): bool
    {
        return $this->isCompany;
    }

    /**
     * @param bool $isCompany
     * @return TrackingPosting
     */
    public function setIsCompany(bool $isCompany): TrackingPosting
    {
        $this->isCompany = $isCompany;
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
     * @return TrackingPosting
     */
    public function setStorage(string $storage): TrackingPosting
    {
        $this->storage = $storage;
        return $this;
    }

    /**
     * @return int
     */
    public function getStorageTime(): int
    {
        return $this->storageTime;
    }

    /**
     * @param int $storageTime
     * @return TrackingPosting
     */
    public function setStorageTime(int $storageTime): TrackingPosting
    {
        $this->storageTime = $storageTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return TrackingPosting
     */
    public function setComment(string $comment): TrackingPosting
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return TrackingPosting
     */
    public function setPhone(string $phone): TrackingPosting
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return TrackingPosting
     */
    public function setEmail(string $email): TrackingPosting
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getCarriageBarcode(): string
    {
        return $this->carriageBarcode;
    }

    /**
     * @param string $carriageBarcode
     * @return TrackingPosting
     */
    public function setCarriageBarcode(string $carriageBarcode): TrackingPosting
    {
        $this->carriageBarcode = $carriageBarcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getExtractPointCode(): string
    {
        return $this->extractPointCode;
    }

    /**
     * @param string $extractPointCode
     * @return TrackingPosting
     */
    public function setExtractPointCode(string $extractPointCode): TrackingPosting
    {
        $this->extractPointCode = $extractPointCode;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsReturn(): bool
    {
        return $this->isReturn;
    }

    /**
     * @param bool $isReturn
     * @return TrackingPosting
     */
    public function setIsReturn(bool $isReturn): TrackingPosting
    {
        $this->isReturn = $isReturn;
        return $this;
    }

    /**
     * @return int
     */
    public function getPickupPlaceId(): int
    {
        return $this->pickupPlaceId;
    }

    /**
     * @param int $pickupPlaceId
     * @return TrackingPosting
     */
    public function setPickupPlaceId(int $pickupPlaceId): TrackingPosting
    {
        $this->pickupPlaceId = $pickupPlaceId;
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
     * @return TrackingPosting
     */
    public function setPickupPlaceName(string $pickupPlaceName): TrackingPosting
    {
        $this->pickupPlaceName = $pickupPlaceName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPickupPlaceAddress(): string
    {
        return $this->pickupPlaceAddress;
    }

    /**
     * @param string $pickupPlaceAddress
     * @return TrackingPosting
     */
    public function setPickupPlaceAddress(string $pickupPlaceAddress): TrackingPosting
    {
        $this->pickupPlaceAddress = $pickupPlaceAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressee(): string
    {
        return $this->addressee;
    }

    /**
     * @param string $addressee
     * @return TrackingPosting
     */
    public function setAddressee(string $addressee): TrackingPosting
    {
        $this->addressee = $addressee;
        return $this;
    }

    /**
     * @return string
     */
    public function getStorageExpirationDate(): string
    {
        return $this->storageExpirationDate;
    }

    /**
     * @param string $storageExpirationDate
     * @return TrackingPosting
     */
    public function setStorageExpirationDate(string $storageExpirationDate): TrackingPosting
    {
        $this->storageExpirationDate = $storageExpirationDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getExternalDeliveryDateTimeFrom(): string
    {
        return $this->externalDeliveryDateTimeFrom;
    }

    /**
     * @param string $externalDeliveryDateTimeFrom
     * @return TrackingPosting
     */
    public function setExternalDeliveryDateTimeFrom(string $externalDeliveryDateTimeFrom): TrackingPosting
    {
        $this->externalDeliveryDateTimeFrom = $externalDeliveryDateTimeFrom;
        return $this;
    }

    /**
     * @return string
     */
    public function getExternalDeliveryDateTimeTo(): string
    {
        return $this->externalDeliveryDateTimeTo;
    }

    /**
     * @param string $externalDeliveryDateTimeTo
     * @return TrackingPosting
     */
    public function setExternalDeliveryDateTimeTo(string $externalDeliveryDateTimeTo): TrackingPosting
    {
        $this->externalDeliveryDateTimeTo = $externalDeliveryDateTimeTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentDeliveryDateTimeFrom(): string
    {
        return $this->currentDeliveryDateTimeFrom;
    }

    /**
     * @param string $currentDeliveryDateTimeFrom
     * @return TrackingPosting
     */
    public function setCurrentDeliveryDateTimeFrom(string $currentDeliveryDateTimeFrom): TrackingPosting
    {
        $this->currentDeliveryDateTimeFrom = $currentDeliveryDateTimeFrom;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentDeliveryDateTimeTo(): string
    {
        return $this->currentDeliveryDateTimeTo;
    }

    /**
     * @param string $currentDeliveryDateTimeTo
     * @return TrackingPosting
     */
    public function setCurrentDeliveryDateTimeTo(string $currentDeliveryDateTimeTo): TrackingPosting
    {
        $this->currentDeliveryDateTimeTo = $currentDeliveryDateTimeTo;
        return $this;
    }

    /**
     * @return ItemList
     */
    public function getItems(): ItemList
    {
        return $this->items;
    }

    /**
     * @param array $array
     * @return TrackingPosting
     * @throws BadResponseException
     */
    public function setItems(array $array): TrackingPosting
    {
        $collection = new ItemList();
        $this->items = $collection->fillFromArray($array);
        return $this;
    }

}