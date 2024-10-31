<?php


namespace Ipol\Ozon\Api\Entity\Common;


use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Common\Part\Manifest\Person;
use Ipol\Ozon\Api\Entity\Common\Part\Manifest\PostingItemList;

/**
 * Class Manifest
 * @package Ipol\Ozon\Api\Entity\Request\Part\ManifestUpload
 */
class Manifest extends AbstractEntity
{
    /**
     * @var string
     */
    protected $postingBarcode;
    /**
     * @var string
     */
    protected $postingNumber;
    /**
     * @var null //not used for now on their side
     */
    protected $postingOutId;
    /**
     * @var \Ipol\Ozon\Api\Entity\Common\Part\Person
     */
    protected $recipient;
    /**
     * @var \Ipol\Ozon\Api\Entity\Common\Part\Person
     */
    protected $addressee;
    /**
     * @var string
     */
    protected $recipientEmail;
    /**
     * @var string
     */
    protected $recipientPhone;
    /**
     * @var string
     */
    protected $recipientComment;
    /**
     * @var bool
     */
    protected $isCompany;
    /**
     * @var string
     */
    protected $companyName;
    /**
     * @var string
     */
    protected $recipientAddress;
    /**
     * @var float
     */
    protected $prepayment;
    /**
     * @var int (1 - 100% prepaid, 4 - 100% payment on delivery)
     */
    protected $prepaymentType;
    /**
     * @var int
     */
    protected $deliveryVariantId;
    /**
     * @var float
     */
    protected $deliveryPrice;
    /**
     * @var null //not used for now on their side
     */
    protected $deliveryCost;
    /**
     * @var int
     */
    protected $deliveryPriceNDS;
    /**
     * @var int
     */
    protected $deliveryCostNDS;
    /**
     * @var int
     */
    protected $fromPlaceId;
    /**
     * @var bool
     */
    protected $isUncoveredDisabled;
    /**
     * @var false //TODO check format after OZON answer
     */
    protected $isFf;
    /**
     * @var float
     */
    protected $amountRecipientPayment;
    /**
     * @var float (must be equal to SUM(PostingItem->estimatedCost[]))
     */
    protected $postingCost;
    /**
     * @var int gram
     */
    protected $weight;
    /**
     * @var PostingItemList
     */
    protected $postingItems;
    /**
     * @var int
     */
    protected $multiSeatId;
    /**
     * @var int
     */
    protected $timeSlotId;

    /**
     * @return string
     */
    public function getPostingBarcode(): ?string
    {
        return $this->postingBarcode;
    }

    /**
     * @param string $postingBarcode
     * @return Manifest
     */
    public function setPostingBarcode(string $postingBarcode)
    {
        $this->postingBarcode = $postingBarcode;
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
     * @return Manifest
     */
    public function setPostingNumber(string $postingNumber)
    {
        $this->postingNumber = $postingNumber;
        return $this;
    }

    /**
     * @return null
     */
    public function getPostingOutId()
    {
        return $this->postingOutId;
    }

    /**
     * @param null $postingOutId
     * @return Manifest
     */
    public function setPostingOutId($postingOutId)
    {
        $this->postingOutId = $postingOutId;
        return $this;
    }

    /**
     * @return \Ipol\Ozon\Api\Entity\Common\Part\Person
     */
    public function getRecipient(): Person
    {
        return $this->recipient;
    }

    /**
     * @param mixed $recipient
     * @return Manifest
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @return \Ipol\Ozon\Api\Entity\Common\Part\Person
     */
    public function getAddressee(): ?Person
    {
        return $this->addressee;
    }

    /**
     * @param mixed $addressee
     * @return Manifest
     */
    public function setAddressee($addressee)
    {
        $this->addressee = $addressee;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipientEmail(): ?string
    {
        return $this->recipientEmail;
    }

    /**
     * @param string $recipientEmail
     * @return Manifest
     */
    public function setRecipientEmail(string $recipientEmail)
    {
        $this->recipientEmail = $recipientEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipientPhone(): string
    {
        return $this->recipientPhone;
    }

    /**
     * @param string $recipientPhone
     * @return Manifest
     */
    public function setRecipientPhone(string $recipientPhone)
    {
        $this->recipientPhone = $recipientPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipientComment(): ?string
    {
        return $this->recipientComment;
    }

    /**
     * @param string $recipientComment
     * @return Manifest
     */
    public function setRecipientComment(string $recipientComment)
    {
        $this->recipientComment = $recipientComment;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCompany(): ?bool
    {
        return $this->isCompany;
    }

    /**
     * @param bool $isCompany
     * @return Manifest
     */
    public function setIsCompany(bool $isCompany)
    {
        $this->isCompany = $isCompany;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     * @return Manifest
     */
    public function setCompanyName(string $companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipientAddress(): ?string
    {
        return $this->recipientAddress;
    }

    /**
     * @param string $recipientAddress
     * @return Manifest
     */
    public function setRecipientAddress(string $recipientAddress)
    {
        $this->recipientAddress = $recipientAddress;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrepayment(): ?float
    {
        return $this->prepayment;
    }

    /**
     * @param float $prepayment
     * @return Manifest
     */
    public function setPrepayment(float $prepayment)
    {
        $this->prepayment = $prepayment;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrepaymentType(): int
    {
        return $this->prepaymentType;
    }

    /**
     * @param int $prepaymentType
     * @return Manifest
     */
    public function setPrepaymentType(int $prepaymentType)
    {
        $this->prepaymentType = $prepaymentType;
        return $this;
    }

    /**
     * @return int
     */
    public function getDeliveryVariantId(): int
    {
        return $this->deliveryVariantId;
    }

    /**
     * @param int $deliveryVariantId
     * @return Manifest
     */
    public function setDeliveryVariantId(int $deliveryVariantId)
    {
        $this->deliveryVariantId = $deliveryVariantId;
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
     * @return Manifest
     */
    public function setDeliveryPrice(float $deliveryPrice)
    {
        $this->deliveryPrice = $deliveryPrice;
        return $this;
    }

    /**
     * @return null
     */
    public function getDeliveryCost()
    {
        return $this->deliveryCost;
    }

    /**
     * @param null $deliveryCost
     * @return Manifest
     */
    public function setDeliveryCost($deliveryCost)
    {
        $this->deliveryCost = $deliveryCost;
        return $this;
    }

    /**
     * @return int
     */
    public function getDeliveryPriceNDS(): ?int
    {
        return $this->deliveryPriceNDS;
    }

    /**
     * @param int $deliveryPriceNDS
     * @return Manifest
     */
    public function setDeliveryPriceNDS(int $deliveryPriceNDS)
    {
        $this->deliveryPriceNDS = $deliveryPriceNDS;
        return $this;
    }

    /**
     * @return int
     */
    public function getDeliveryCostNDS(): ?int
    {
        return $this->deliveryCostNDS;
    }

    /**
     * @param int $deliveryCostNDS
     * @return Manifest
     */
    public function setDeliveryCostNDS(int $deliveryCostNDS)
    {
        $this->deliveryCostNDS = $deliveryCostNDS;
        return $this;
    }

    /**
     * @return int
     */
    public function getFromPlaceId(): ?int
    {
        return $this->fromPlaceId;
    }

    /**
     * @param int $fromPlaceId
     * @return Manifest
     */
    public function setFromPlaceId(int $fromPlaceId)
    {
        $this->fromPlaceId = $fromPlaceId;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsUncoveredDisabled(): ?bool
    {
        return $this->isUncoveredDisabled;
    }

    /**
     * @param bool $isUncoveredDisabled
     * @return Manifest
     */
    public function setIsUncoveredDisabled(bool $isUncoveredDisabled)
    {
        $this->isUncoveredDisabled = $isUncoveredDisabled;
        return $this;
    }

    /**
     * @return false
     */
    public function getIsFf(): bool
    {
        return $this->isFf;
    }

    /**
     * @param false $isFf
     * @return Manifest
     */
    public function setIsFf(bool $isFf)
    {
        $this->isFf = $isFf;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountRecipientPayment(): float
    {
        return $this->amountRecipientPayment;
    }

    /**
     * @param float $amountRecipientPayment
     * @return Manifest
     */
    public function setAmountRecipientPayment(float $amountRecipientPayment)
    {
        $this->amountRecipientPayment = $amountRecipientPayment;
        return $this;
    }

    /**
     * @return float
     */
    public function getPostingCost(): float
    {
        return $this->postingCost;
    }

    /**
     * @param float $postingCost
     * @return Manifest
     */
    public function setPostingCost(float $postingCost)
    {
        $this->postingCost = $postingCost;
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
     * @return Manifest
     */
    public function setWeight(int $weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return PostingItemList
     */
    public function getPostingItems(): PostingItemList
    {
        return $this->postingItems;
    }

    /**
     * @param mixed $postingItems
     * @return Manifest
     */
    public function setPostingItems($postingItems)
    {
        $this->postingItems = $postingItems;
        return $this;
    }

    /**
     * @return int
     */
    public function getMultiSeatId(): ?int
    {
        return $this->multiSeatId;
    }

    /**
     * @param int $multiSeatId
     * @return Manifest
     */
    public function setMultiSeatId(int $multiSeatId)
    {
        $this->multiSeatId = $multiSeatId;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimeSlotId(): ?int
    {
        return $this->timeSlotId;
    }

    /**
     * @param int $timeSlotId
     * @return Manifest
     */
    public function setTimeSlotId(int $timeSlotId)
    {
        $this->timeSlotId = $timeSlotId;
        return $this;
    }

}