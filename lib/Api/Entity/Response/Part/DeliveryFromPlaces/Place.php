<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\DeliveryFromPlaces;

use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Place
 * @package Ipol\Ozon\Api\Entity\Response\Part\DeliveryFromPlaces
 */
class Place extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $city;
    /**
     * @var string
     */
    protected $address;
    /**
     * @var string
     */
    protected $utcOffset;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Place
     */
    public function setId(int $id): Place
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Place
     */
    public function setName(string $name): Place
    {
        $this->name = $name;
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
     * @return Place
     */
    public function setCity(string $city): Place
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Place
     */
    public function setAddress(string $address): Place
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getUtcOffset(): ?string
    {
        return $this->utcOffset;
    }

    /**
     * @param string $utcOffset
     * @return Place
     */
    public function setUtcOffset(string $utcOffset): Place
    {
        $this->utcOffset = $utcOffset;
        return $this;
    }

}