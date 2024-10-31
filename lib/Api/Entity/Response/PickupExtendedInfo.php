<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\Common\WorkingHoursList;
use Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo\AddressDetails;
use Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo\Coordinates;
use Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo\DeliveryType;
use Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo\MetroStationList;
use Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo\PropertyList;

/**
 * Class PickupExtendedInfo
 * @package Ipol\Ozon\Api\Entity\Response
 */
class PickupExtendedInfo extends AbstractResponse
{
    /**
     * @var MetroStationList
     */
    protected $metroStations;
    /**
     * @var int
     */
    protected $externalDeliveryVariantId;
    /**
     * @var string[] - array of url's
     */
    protected $images;
    /**
     * @var string
     */
    protected $locationUid;
    /**
     * @var string
     */
    protected $howToGet;
    /**
     * @var string
     */
    protected $postalCode;
    /**
     * @var AddressDetails
     */
    protected $addressDetails;
    /**
     * @var string
     */
    protected $address;
    /**
     * @var int
     */
    protected $id;
    /**
     * @var WorkingHoursList
     */
    protected $workingHours;
    /**
     * @var Coordinates
     */
    protected $coordinates;
    /**
     * @var PropertyList
     */
    protected $properties;
    /**
     * @var int
     */
    protected $storagePeriod;
    /**
     * @var DeliveryType
     */
    protected $deliveryType;

    /**
     * @return MetroStationList
     */
    public function getMetroStations(): ?MetroStationList
    {
        return $this->metroStations;
    }

    /**
     * @param array $array
     * @return PickupExtendedInfo
     * @throws BadResponseException
     */
    public function setMetroStations(array $array): PickupExtendedInfo
    {
        $collection = new MetroStationList();
        $this->metroStations = $collection->fillFromArray($array);
        return $this;
    }

    /**
     * @return int
     */
    public function getExternalDeliveryVariantId(): int
    {
        return $this->externalDeliveryVariantId;
    }

    /**
     * @param int $externalDeliveryVariantId
     * @return PickupExtendedInfo
     */
    public function setExternalDeliveryVariantId(int $externalDeliveryVariantId): PickupExtendedInfo
    {
        $this->externalDeliveryVariantId = $externalDeliveryVariantId;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getImages(): ?array
    {
        return $this->images;
    }

    /**
     * @param string[] $images
     * @return PickupExtendedInfo
     */
    public function setImages(array $images): PickupExtendedInfo
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocationUid(): ?string
    {
        return $this->locationUid;
    }

    /**
     * @param string $locationUid
     * @return PickupExtendedInfo
     */
    public function setLocationUid(string $locationUid): PickupExtendedInfo
    {
        $this->locationUid = $locationUid;
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
     * @return PickupExtendedInfo
     */
    public function setHowToGet(string $howToGet): PickupExtendedInfo
    {
        $this->howToGet = $howToGet;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return PickupExtendedInfo
     */
    public function setPostalCode(string $postalCode): PickupExtendedInfo
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return AddressDetails
     */
    public function getAddressDetails(): AddressDetails
    {
        return $this->addressDetails;
    }

    /**
     * @param array $addressDetails
     * @return PickupExtendedInfo
     */
    public function setAddressDetails(array $addressDetails): PickupExtendedInfo
    {
        $this->addressDetails = new AddressDetails($addressDetails);
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
     * @return PickupExtendedInfo
     */
    public function setAddress(string $address): PickupExtendedInfo
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return PickupExtendedInfo
     */
    public function setId(int $id): PickupExtendedInfo
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return WorkingHoursList
     */
    public function getWorkingHours(): WorkingHoursList
    {
        return $this->workingHours;
    }

    /**
     * @param array $array
     * @return PickupExtendedInfo
     * @throws BadResponseException
     */
    public function setWorkingHours(array $array): PickupExtendedInfo
    {
        $collection = new WorkingHoursList();
        $this->workingHours = $collection->fillFromArray($array);
        return $this;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinates(): ?Coordinates
    {
        return $this->coordinates;
    }

    /**
     * @param array $coordinates
     * @return PickupExtendedInfo
     */
    public function setCoordinates(array $coordinates): PickupExtendedInfo
    {
        $this->coordinates = new Coordinates($coordinates);
        return $this;
    }

    /**
     * @return PropertyList
     */
    public function getProperties(): ?PropertyList
    {
        return $this->properties;
    }

    /**
     * @param array $array
     * @return PickupExtendedInfo
     * @throws BadResponseException
     */
    public function setProperties(array $array): PickupExtendedInfo
    {
        $collection = new PropertyList();
        $this->properties = $collection->fillFromArray($array);
        return $this;
    }

    /**
     * @return int
     */
    public function getStoragePeriod(): ?int
    {
        return $this->storagePeriod;
    }

    /**
     * @param int $storagePeriod
     * @return PickupExtendedInfo
     */
    public function setStoragePeriod(int $storagePeriod): PickupExtendedInfo
    {
        $this->storagePeriod = $storagePeriod;
        return $this;
    }

    /**
     * @return DeliveryType
     */
    public function getDeliveryType(): DeliveryType
    {
        return $this->deliveryType;
    }

    /**
     * @param array $deliveryType
     * @return PickupExtendedInfo
     */
    public function setDeliveryType(array $deliveryType): PickupExtendedInfo
    {
        $this->deliveryType = new DeliveryType($deliveryType);
        return $this;
    }

}