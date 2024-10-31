<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\OrderById;


use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class FirstMileTransfer
 * @package Ipol\Ozon\Api\Entity\Response\Part\OrderById
 */
class FirstMileTransfer extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $fromPlaceId;
    /**
     * @var int
     */
    protected $dropOffRequestId;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return FirstMileTransfer
     */
    public function setType(string $type): FirstMileTransfer
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getFromPlaceId(): string
    {
        return $this->fromPlaceId;
    }

    /**
     * @param string $fromPlaceId
     * @return FirstMileTransfer
     */
    public function setFromPlaceId(string $fromPlaceId): FirstMileTransfer
    {
        $this->fromPlaceId = $fromPlaceId;
        return $this;
    }

    /**
     * @return int
     */
    public function getDropOffRequestId(): int
    {
        return $this->dropOffRequestId;
    }

    /**
     * @param int $dropOffRequestId
     * @return FirstMileTransfer
     */
    public function setDropOffRequestId(int $dropOffRequestId): FirstMileTransfer
    {
        $this->dropOffRequestId = $dropOffRequestId;
        return $this;
    }

}