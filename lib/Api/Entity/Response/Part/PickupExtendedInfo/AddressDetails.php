<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo;

use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;


/**
 * Class AddressDetails
 * @package Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo
 */
class AddressDetails extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var string
     */
    protected $street;
    /**
     * @var string
     */
    protected $city;
    /**
     * @var string
     */
    protected $region;
    /**
     * @var string
     */
    protected $buildingUid;
    /**
     * @var string
     */
    protected $house;

    /**
     * @return string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return AddressDetails
     */
    public function setStreet(string $street): AddressDetails
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return AddressDetails
     */
    public function setCity(string $city): AddressDetails
    {
        $this->city = $city;
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
     * @return AddressDetails
     */
    public function setRegion(string $region): AddressDetails
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuildingUid(): ?string
    {
        return $this->buildingUid;
    }

    /**
     * @param string $buildingUid
     * @return AddressDetails
     */
    public function setBuildingUid(string $buildingUid): AddressDetails
    {
        $this->buildingUid = $buildingUid;
        return $this;
    }

    /**
     * @return string
     */
    public function getHouse(): ?string
    {
        return $this->house;
    }

    /**
     * @param string $house
     * @return AddressDetails
     */
    public function setHouse(string $house): AddressDetails
    {
        $this->house = $house;
        return $this;
    }

}