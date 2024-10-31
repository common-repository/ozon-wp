<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\Common;

use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;


/**
 * Class Data
 * @package Ipol\Ozon\Api\Entity\Response\Part\Common
 */
class Data extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $objectTypeId;
    /**
     * @var string
     */
    protected $objectTypeName;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var string
     */
    protected $address;
    /**
     * @var string
     */
    protected $region;
    /**
     * @var string
     */
    protected $settlement;
    /**
     * @var string
     */
    protected $streets;
    /**
     * @var string
     */
    protected $placement;
    /**
     * @var bool
     */
    protected $enabled;
    /**
     * @var int
     */
    protected $cityId;
    /**
     * @var string
     */
    protected $fiasGuid;
    /**
     * @var string
     */
    protected $fiasGuidControl;
    /**
     * @var int
     */
    protected $addressElementId;
    /**
     * @var bool
     */
    protected $fittingShoesAvailable;
    /**
     * @var bool
     */
    protected $fittingClothesAvailable;
    /**
     * @var bool
     */
    protected $cardPaymentAvailable;
    /**
     * @var string
     */
    protected $howToGet;
    /**
     * @var string
     */
    protected $phone;
    /**
     * @var string
     */
    protected $contractorName;
    /**
     * @var int
     */
    protected $contractorId;
    /**
     * @var string
     */
    protected $stateName;
    /**
     * @var float
     */
    protected $minWeight;
    /**
     * @var float
     */
    protected $maxWeight;
    /**
     * @var float
     */
    protected $minPrice;
    /**
     * @var float
     */
    protected $maxPrice;
    /**
     * @var int (mm)
     */
    protected $restrictionWidth;
    /**
     * @var int (mm)
     */
    protected $restrictionLength;
    /**
     * @var int (mm)
     */
    protected $restrictionHeight;
    /**
     * @var string
     */
    protected $lat;
    /**
     * @var string
     */
    protected $long;
    /**
     * @var bool
     */
    protected $returnAvailable;
    /**
     * @var bool
     */
    protected $partialGiveOutAvailable;
    /**
     * @var bool
     */
    protected $dangerousAvailable;
    /**
     * @var bool
     */
    protected $isCashForbidden;
    /**
     * @var string
     */
    protected $code;
    /**
     * @var bool
     */
    protected $wifiAvailable;
    /**
     * @var bool
     */
    protected $legalEntityNotAvailable;
    /**
     * @var string (DateTime)
     */
    protected $dateOpen;
    /**
     * @var string (DateTime)
     */
    protected $dateClose;
    /**
     * @var bool
     */
    protected $isRestrictionAccess;
    /**
     * @var string
     */
    protected $restrictionAccessMessage;
    /**
     * @var string
     */
    protected $utcOffsetStr;
    /**
     * @var bool
     */
    protected $isPartialPrepaymentForbidden;
    /**
     * @var bool
     */
    protected $isGeozoneAvailable;
    /**
     * @var int
     */
    protected $postalCode;
    /**
     * @var WorkingHoursList
     */
    protected $workingHours;
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Data
     */
    public function setId(int $id): Data
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getObjectTypeId(): int
    {
        return $this->objectTypeId;
    }

    /**
     * @param int $objectTypeId
     * @return Data
     */
    public function setObjectTypeId(int $objectTypeId): Data
    {
        $this->objectTypeId = $objectTypeId;
        return $this;
    }

    /**
     * @return string
     */
    public function getObjectTypeName(): string
    {
        return $this->objectTypeName;
    }

    /**
     * @param string $objectTypeName
     * @return Data
     */
    public function setObjectTypeName(string $objectTypeName): Data
    {
        $this->objectTypeName = $objectTypeName;
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
     * @return Data
     */
    public function setName(string $name): Data
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Data
     */
    public function setDescription(string $description): Data
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Data
     */
    public function setAddress(string $address): Data
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return Data
     */
    public function setRegion(string $region): Data
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return string
     */
    public function getSettlement(): ?string
    {
        return $this->settlement;
    }

    /**
     * @param string $settlement
     * @return Data
     */
    public function setSettlement(string $settlement): Data
    {
        $this->settlement = $settlement;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreets(): string
    {
        return $this->streets;
    }

    /**
     * @param string $streets
     * @return Data
     */
    public function setStreets(string $streets): Data
    {
        $this->streets = $streets;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlacement(): string
    {
        return $this->placement;
    }

    /**
     * @param string $placement
     * @return Data
     */
    public function setPlacement(string $placement): Data
    {
        $this->placement = $placement;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return Data
     */
    public function setEnabled(bool $enabled): Data
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->cityId;
    }

    /**
     * @param int $cityId
     * @return Data
     */
    public function setCityId(int $cityId): Data
    {
        $this->cityId = $cityId;
        return $this;
    }

    /**
     * @return string
     */
    public function getFiasGuid(): string
    {
        return $this->fiasGuid;
    }

    /**
     * @param string $fiasGuid
     * @return Data
     */
    public function setFiasGuid(string $fiasGuid): Data
    {
        $this->fiasGuid = $fiasGuid;
        return $this;
    }

    /**
     * @return string
     */
    public function getFiasGuidControl(): string
    {
        return $this->fiasGuidControl;
    }

    /**
     * @param string $fiasGuidControl
     * @return Data
     */
    public function setFiasGuidControl(string $fiasGuidControl): Data
    {
        $this->fiasGuidControl = $fiasGuidControl;
        return $this;
    }

    /**
     * @return int
     */
    public function getAddressElementId(): int
    {
        return $this->addressElementId;
    }

    /**
     * @param int $addressElementId
     * @return Data
     */
    public function setAddressElementId(int $addressElementId): Data
    {
        $this->addressElementId = $addressElementId;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFittingShoesAvailable(): bool
    {
        return $this->fittingShoesAvailable;
    }

    /**
     * @param bool $fittingShoesAvailable
     * @return Data
     */
    public function setFittingShoesAvailable(bool $fittingShoesAvailable): Data
    {
        $this->fittingShoesAvailable = $fittingShoesAvailable;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFittingClothesAvailable(): bool
    {
        return $this->fittingClothesAvailable;
    }

    /**
     * @param bool $fittingClothesAvailable
     * @return Data
     */
    public function setFittingClothesAvailable(bool $fittingClothesAvailable): Data
    {
        $this->fittingClothesAvailable = $fittingClothesAvailable;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCardPaymentAvailable(): bool
    {
        return $this->cardPaymentAvailable;
    }

    /**
     * @param bool $cardPaymentAvailable
     * @return Data
     */
    public function setCardPaymentAvailable(bool $cardPaymentAvailable): Data
    {
        $this->cardPaymentAvailable = $cardPaymentAvailable;
        return $this;
    }

    /**
     * @return string
     */
    public function getHowToGet(): ?string
    {
        return $this->howToGet;
    }

    /**
     * @param string $howToGet
     * @return Data
     */
    public function setHowToGet(string $howToGet): Data
    {
        $this->howToGet = $howToGet;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Data
     */
    public function setPhone(string $phone): Data
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getContractorName(): ?string
    {
        return $this->contractorName;
    }

    /**
     * @param string $contractorName
     * @return Data
     */
    public function setContractorName(string $contractorName): Data
    {
        $this->contractorName = $contractorName;
        return $this;
    }

    /**
     * @return int
     */
    public function getContractorId(): int
    {
        return $this->contractorId;
    }

    /**
     * @param int $contractorId
     * @return Data
     */
    public function setContractorId(int $contractorId): Data
    {
        $this->contractorId = $contractorId;
        return $this;
    }

    /**
     * @return string
     */
    public function getStateName(): string
    {
        return $this->stateName;
    }

    /**
     * @param string $stateName
     * @return Data
     */
    public function setStateName(string $stateName): Data
    {
        $this->stateName = $stateName;
        return $this;
    }

    /**
     * @return float
     */
    public function getMinWeight(): ?float
    {
        return $this->minWeight;
    }

    /**
     * @param float $minWeight
     * @return Data
     */
    public function setMinWeight(float $minWeight): Data
    {
        $this->minWeight = $minWeight;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxWeight(): ?float
    {
        return $this->maxWeight;
    }

    /**
     * @param float $maxWeight
     * @return Data
     */
    public function setMaxWeight(float $maxWeight): Data
    {
        $this->maxWeight = $maxWeight;
        return $this;
    }

    /**
     * @return float
     */
    public function getMinPrice(): ?float
    {
        return $this->minPrice;
    }

    /**
     * @param float $minPrice
     * @return Data
     */
    public function setMinPrice(float $minPrice): Data
    {
        $this->minPrice = $minPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxPrice(): ?float
    {
        return $this->maxPrice;
    }

    /**
     * @param float $maxPrice
     * @return Data
     */
    public function setMaxPrice(float $maxPrice): Data
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return int
     */
    public function getRestrictionWidth(): ?int
    {
        return $this->restrictionWidth;
    }

    /**
     * @param int $restrictionWidth
     * @return Data
     */
    public function setRestrictionWidth(int $restrictionWidth): Data
    {
        $this->restrictionWidth = $restrictionWidth;
        return $this;
    }

    /**
     * @return int
     */
    public function getRestrictionLength(): ?int
    {
        return $this->restrictionLength;
    }

    /**
     * @param int $restrictionLength
     * @return Data
     */
    public function setRestrictionLength(int $restrictionLength): Data
    {
        $this->restrictionLength = $restrictionLength;
        return $this;
    }

    /**
     * @return int
     */
    public function getRestrictionHeight(): ?int
    {
        return $this->restrictionHeight;
    }

    /**
     * @param int $restrictionHeight
     * @return Data
     */
    public function setRestrictionHeight(int $restrictionHeight): Data
    {
        $this->restrictionHeight = $restrictionHeight;
        return $this;
    }

    /**
     * @return string
     */
    public function getLat(): string
    {
        return $this->lat;
    }

    /**
     * @param string $lat
     * @return Data
     */
    public function setLat(string $lat): Data
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return string
     */
    public function getLong(): string
    {
        return $this->long;
    }

    /**
     * @param string $long
     * @return Data
     */
    public function setLong(string $long): Data
    {
        $this->long = $long;
        return $this;
    }

    /**
     * @return bool
     */
    public function isReturnAvailable(): bool
    {
        return $this->returnAvailable;
    }

    /**
     * @param bool $returnAvailable
     * @return Data
     */
    public function setReturnAvailable(bool $returnAvailable): Data
    {
        $this->returnAvailable = $returnAvailable;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPartialGiveOutAvailable(): bool
    {
        return $this->partialGiveOutAvailable;
    }

    /**
     * @param bool $partialGiveOutAvailable
     * @return Data
     */
    public function setPartialGiveOutAvailable(bool $partialGiveOutAvailable): Data
    {
        $this->partialGiveOutAvailable = $partialGiveOutAvailable;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDangerousAvailable(): bool
    {
        return $this->dangerousAvailable;
    }

    /**
     * @param bool $dangerousAvailable
     * @return Data
     */
    public function setDangerousAvailable(bool $dangerousAvailable): Data
    {
        $this->dangerousAvailable = $dangerousAvailable;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsCashForbidden(): bool
    {
        return $this->isCashForbidden;
    }

    /**
     * @param bool $isCashForbidden
     * @return Data
     */
    public function setIsCashForbidden(bool $isCashForbidden): Data
    {
        $this->isCashForbidden = $isCashForbidden;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Data
     */
    public function setCode(string $code): Data
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return bool
     */
    public function isWifiAvailable(): bool
    {
        return $this->wifiAvailable;
    }

    /**
     * @param bool $wifiAvailable
     * @return Data
     */
    public function setWifiAvailable(bool $wifiAvailable): Data
    {
        $this->wifiAvailable = $wifiAvailable;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLegalEntityNotAvailable(): bool
    {
        return $this->legalEntityNotAvailable;
    }

    /**
     * @param bool $legalEntityNotAvailable
     * @return Data
     */
    public function setLegalEntityNotAvailable(bool $legalEntityNotAvailable): Data
    {
        $this->legalEntityNotAvailable = $legalEntityNotAvailable;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateOpen(): string
    {
        return $this->dateOpen;
    }

    /**
     * @param string $dateOpen
     * @return Data
     */
    public function setDateOpen(string $dateOpen): Data
    {
        $this->dateOpen = $dateOpen;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateClose(): string
    {
        return $this->dateClose;
    }

    /**
     * @param string $dateClose
     * @return Data
     */
    public function setDateClose(string $dateClose): Data
    {
        $this->dateClose = $dateClose;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsRestrictionAccess(): bool
    {
        return $this->isRestrictionAccess;
    }

    /**
     * @param bool $isRestrictionAccess
     * @return Data
     */
    public function setIsRestrictionAccess(bool $isRestrictionAccess): Data
    {
        $this->isRestrictionAccess = $isRestrictionAccess;
        return $this;
    }

    /**
     * @return string
     */
    public function getRestrictionAccessMessage(): ?string
    {
        return $this->restrictionAccessMessage;
    }

    /**
     * @param string $restrictionAccessMessage
     * @return Data
     */
    public function setRestrictionAccessMessage(string $restrictionAccessMessage): Data
    {
        $this->restrictionAccessMessage = $restrictionAccessMessage;
        return $this;
    }

    /**
     * @return string
     */
    public function getUtcOffsetStr(): string
    {
        return $this->utcOffsetStr;
    }

    /**
     * @param string $utcOffsetStr
     * @return Data
     */
    public function setUtcOffsetStr(string $utcOffsetStr): Data
    {
        $this->utcOffsetStr = $utcOffsetStr;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsPartialPrepaymentForbidden(): bool
    {
        return $this->isPartialPrepaymentForbidden;
    }

    /**
     * @param bool $isPartialPrepaymentForbidden
     * @return Data
     */
    public function setIsPartialPrepaymentForbidden(bool $isPartialPrepaymentForbidden): Data
    {
        $this->isPartialPrepaymentForbidden = $isPartialPrepaymentForbidden;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsGeozoneAvailable(): bool
    {
        return $this->isGeozoneAvailable;
    }

    /**
     * @param bool $isGeozoneAvailable
     * @return Data
     */
    public function setIsGeozoneAvailable(bool $isGeozoneAvailable): Data
    {
        $this->isGeozoneAvailable = $isGeozoneAvailable;
        return $this;
    }

    /**
     * @return int
     */
    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    /**
     * @param int $postalCode
     * @return Data
     */
    public function setPostalCode(int $postalCode): Data
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return WorkingHoursList
     */
    public function getWorkingHours(): ?WorkingHoursList
    {
        return $this->workingHours;
    }

    /**
     * @param array $array
     * @return Data
     * @throws BadResponseException
     */
    public function setWorkingHours(array $array): Data
    {
        $collection = new WorkingHoursList();
        $this->workingHours = $collection->fillFromArray($array);
        return $this;
    }

}