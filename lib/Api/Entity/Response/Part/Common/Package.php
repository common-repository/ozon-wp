<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\Common;


use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Package
 * @package Ipol\Ozon\Api\Entity\Response\Part\Common
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
     * @var int
     */
    protected $postingId;
    /**
     * @var string
     */
    protected $barCode;

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

}