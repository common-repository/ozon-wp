<?php


namespace Ipol\Ozon\Api\Entity\Response;


/**
 * Class Dropoff
 * @package Ipol\Ozon\Api\Entity\Response
 */
class Dropoff extends AbstractResponse
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
     * @var string dateTime "2021-04-23T11:24:58.190Z"
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
     * @return Dropoff
     */
    public function setId(int $id): Dropoff
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
     * @return Dropoff
     */
    public function setPrincipalId(int $principalId): Dropoff
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
     * @return Dropoff
     */
    public function setCreatedAt(string $createdAt): Dropoff
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
     * @return Dropoff
     */
    public function setActId(int $actId): Dropoff
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
     * @return Dropoff
     */
    public function setStatus(string $status): Dropoff
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
     * @return Dropoff
     */
    public function setOrderIds(array $orderIds): Dropoff
    {
        $this->orderIds = $orderIds;
        return $this;
    }

}