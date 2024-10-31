<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class DeliveryVariants
 * @package Ipol\Ozon\Api\Entity\Request
 */
class DeliveryVariants extends AbstractRequest
{
    /**
     * @var string
     */
    protected $cityName;
    /**
     * @var bool
     */
    protected $payloadIncludes__includeWorkingHours;
    /**
     * @var bool
     */
    protected $payloadIncludes__includePostalCode;
    /**
     * @var null|int
     */
    protected $pagination__size;
    /**
     * @var null|string
     */
    protected $pagination__token;
    /**
     * @return string
     */
    public function getCityName(): ?string
    {
        return $this->cityName;
    }

    /**
     * @param string|null $cityName
     * @return DeliveryVariants
     */
    public function setCityName(?string $cityName): DeliveryVariants
    {
        $this->cityName = $cityName;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPayloadIncludesIncludeWorkingHours()
    {
        return $this->payloadIncludes__includeWorkingHours? 'true': 'false';
    }

    /**
     * @param bool $payloadIncludes__includeWorkingHours
     * @return DeliveryVariants
     */
    public function setPayloadIncludesIncludeWorkingHours(bool $payloadIncludes__includeWorkingHours): DeliveryVariants
    {
        $this->payloadIncludes__includeWorkingHours = $payloadIncludes__includeWorkingHours;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPayloadIncludesIncludePostalCode()
    {
        return $this->payloadIncludes__includePostalCode? 'true': 'false';
    }

    /**
     * @param bool $payloadIncludes__includePostalCode
     * @return DeliveryVariants
     */
    public function setPayloadIncludesIncludePostalCode(bool $payloadIncludes__includePostalCode): DeliveryVariants
    {
        $this->payloadIncludes__includePostalCode = $payloadIncludes__includePostalCode;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPaginationSize(): ?int
    {
        return $this->pagination__size;
    }

    /**
     * @param int|null $pagination__size
     * @return DeliveryVariants
     */
    public function setPaginationSize(?int $pagination__size): DeliveryVariants
    {
        $this->pagination__size = $pagination__size;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaginationToken(): ?string
    {
        return $this->pagination__token;
    }

    /**
     * @param string|null $pagination__token
     * @return DeliveryVariants
     */
    public function setPaginationToken(?string $pagination__token): DeliveryVariants
    {
        $this->pagination__token = $pagination__token;
        return $this;
    }

}