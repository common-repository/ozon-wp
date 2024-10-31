<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\ManifestUnprocessed;


use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Data
 * @package Ipol\Ozon\Api\Entity\Response\Part\DocumentList
 */
class Data extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var Posting
     */
    protected $posting;
    /**
     * @var string
     */
    protected $status;
    /**
     * @var string
     */
    protected $deliveryVariantName;
    /**
     * @var string (DateTime)
     */
    protected $dateLoad;
    /**
     * @var bool
     */
    protected $isCancelled;

    /**
     * @return Posting
     */
    public function getPosting(): Posting
    {
        return $this->posting;
    }

    /**
     * @param mixed $posting
     * @return Data
     */
    public function setPosting($posting): Data
    {
        $this->posting = new Posting($posting);
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Data
     */
    public function setStatus(string $status): Data
    {
        $this->status = $status;
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
     * @return Data
     */
    public function setDeliveryVariantName(string $deliveryVariantName): Data
    {
        $this->deliveryVariantName = $deliveryVariantName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateLoad(): string
    {
        return $this->dateLoad;
    }

    /**
     * @param string $dateLoad
     * @return Data
     */
    public function setDateLoad(string $dateLoad): Data
    {
        $this->dateLoad = $dateLoad;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsCancelled(): bool
    {
        return $this->isCancelled;
    }

    /**
     * @param bool $isCancelled
     * @return Data
     */
    public function setIsCancelled(bool $isCancelled): Data
    {
        $this->isCancelled = $isCancelled;
        return $this;
    }
}