<?php


namespace Ipol\Ozon\Api\Entity\Response;


/**
 * Class ShipmentRequest
 * @package Ipol\Ozon\Api
 * @subpakage Response
 */
class ShipmentRequest extends AbstractResponse
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $principalId;
    /**
     * @var string "2021-09-06T17:10:07.705Z"
     */
    protected $createdAt;
    /**
     * @var int
     */
    protected $actId;
    /**
     * @var string
     */
    protected $status;
    /**
     * @var int[]
     */
    protected $orderIds;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ShipmentRequest
     */
    public function setId(int $id): ShipmentRequest
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrincipalId(): int
    {
        return $this->principalId;
    }

    /**
     * @param int $principalId
     * @return ShipmentRequest
     */
    public function setPrincipalId(int $principalId): ShipmentRequest
    {
        $this->principalId = $principalId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return ShipmentRequest
     */
    public function setCreatedAt(string $createdAt): ShipmentRequest
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getActId(): int
    {
        return $this->actId;
    }

    /**
     * @param int $actId
     * @return ShipmentRequest
     */
    public function setActId(int $actId): ShipmentRequest
    {
        $this->actId = $actId;
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
     * @return ShipmentRequest
     */
    public function setStatus(string $status): ShipmentRequest
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int[]
     */
    public function getOrderIds(): array
    {
        return $this->orderIds;
    }

    /**
     * @param int[] $orderIds
     * @return ShipmentRequest
     */
    public function setOrderIds(array $orderIds): ShipmentRequest
    {
        $this->orderIds = $orderIds;
        return $this;
    }
}