<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\OrderById;


use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;
use Ipol\Ozon\Api\Entity\Response\Part\Common\Dimensions;
use stdClass;

/**
 * Class Package
 * @package Ipol\Ozon\Api\Entity\Response\Part\OrderById
 */
class Package extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var string
     */
    protected $packageNumber;
    /**
     * @var string
     */
    protected $postingNumber;
    /**
     * @var string
     */
    protected $status;
    /**
     * @var Dimensions
     */
    protected $dimensions;
    /**
     * @var string
     */
    protected $barCode;
    /**
     * @var int
     */
    protected $postingId;

    /**
     * @return string
     */
    public function getPackageNumber(): string
    {
        return $this->packageNumber;
    }

    /**
     * @param string $packageNumber
     * @return Package
     */
    public function setPackageNumber(string $packageNumber): Package
    {
        $this->packageNumber = $packageNumber;
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
     * @return Package
     */
    public function setPostingNumber(string $postingNumber): Package
    {
        $this->postingNumber = $postingNumber;
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
     * @return Package
     */
    public function setStatus(string $status): Package
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Dimensions
     */
    public function getDimensions(): Dimensions
    {
        return $this->dimensions;
    }

    /**
     * @param stdClass $dimensions
     * @return Package
     */
    public function setDimensions($dimensions): Package
    {
        $this->dimensions = new Dimensions($dimensions);
        return $this;
    }

    /**
     * @return string
     */
    public function getBarCode(): string
    {
        return $this->barCode;
    }

    /**
     * @param string $barCode
     * @return Package
     */
    public function setBarCode(string $barCode): Package
    {
        $this->barCode = $barCode;
        return $this;
    }

    /**
     * @return int
     */
    public function getPostingId(): int
    {
        return $this->postingId;
    }

    /**
     * @param int $postingId
     * @return Package
     */
    public function setPostingId(int $postingId): Package
    {
        $this->postingId = $postingId;
        return $this;
    }

}