<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\TariffList;


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
     * @var integer
     */
    protected $id;
    /**
     * @var string
     */
    protected $tariffName;
    /**
     * @var string
     */
    protected $tariffZoneName;
    /**
     * @var integer
     */
    protected $deliveryVariantId;
    /**
     * @var string
     */
    protected $deliveryVariantName;
    /**
     * @var string
     */
    protected $deliveryVariantType;
    /**
     * @var integer
     */
    protected $tariffRateTypeId;
    /**
     * @var string
     */
    protected $tariffRateTypeName;
    /**
     * @var integer
     */
    protected $placeId;
    /**
     * @var string
     */
    protected $placeName;
    /**
     * @var float
     */
    protected $baseAmount;
    /**
     * @var float
     */
    protected $limit;
    /**
     * @var float
     */
    protected $overdraftAmount;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Item
     */
    public function setId(int $id): Item
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTariffName(): string
    {
        return $this->tariffName;
    }

    /**
     * @param string $tariffName
     * @return Item
     */
    public function setTariffName(string $tariffName): Item
    {
        $this->tariffName = $tariffName;
        return $this;
    }

    /**
     * @return string
     */
    public function getTariffZoneName(): string
    {
        return $this->tariffZoneName;
    }

    /**
     * @param string $tariffZoneName
     * @return Item
     */
    public function setTariffZoneName(string $tariffZoneName): Item
    {
        $this->tariffZoneName = $tariffZoneName;
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
     * @return Item
     */
    public function setDeliveryVariantId(int $deliveryVariantId): Item
    {
        $this->deliveryVariantId = $deliveryVariantId;
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
     * @return Item
     */
    public function setDeliveryVariantName(string $deliveryVariantName): Item
    {
        $this->deliveryVariantName = $deliveryVariantName;
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
     * @return Item
     */
    public function setDeliveryVariantType(string $deliveryVariantType): Item
    {
        $this->deliveryVariantType = $deliveryVariantType;
        return $this;
    }

    /**
     * @return int
     */
    public function getTariffRateTypeId(): int
    {
        return $this->tariffRateTypeId;
    }

    /**
     * @param int $tariffRateTypeId
     * @return Item
     */
    public function setTariffRateTypeId(int $tariffRateTypeId): Item
    {
        $this->tariffRateTypeId = $tariffRateTypeId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTariffRateTypeName(): string
    {
        return $this->tariffRateTypeName;
    }

    /**
     * @param string $tariffRateTypeName
     * @return Item
     */
    public function setTariffRateTypeName(string $tariffRateTypeName): Item
    {
        $this->tariffRateTypeName = $tariffRateTypeName;
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
    public function setPlaceId(int $placeId): Item
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
    public function setPlaceName(string $placeName): Item
    {
        $this->placeName = $placeName;
        return $this;
    }

    /**
     * @return float
     */
    public function getBaseAmount(): float
    {
        return $this->baseAmount;
    }

    /**
     * @param float $baseAmount
     * @return Item
     */
    public function setBaseAmount(float $baseAmount): Item
    {
        $this->baseAmount = $baseAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getLimit(): float
    {
        return $this->limit;
    }

    /**
     * @param float $limit
     * @return Item
     */
    public function setLimit(float $limit): Item
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return float
     */
    public function getOverdraftAmount(): float
    {
        return $this->overdraftAmount;
    }

    /**
     * @param float $overdraftAmount
     * @return Item
     */
    public function setOverdraftAmount(float $overdraftAmount): Item
    {
        $this->overdraftAmount = $overdraftAmount;
        return $this;
    }

}