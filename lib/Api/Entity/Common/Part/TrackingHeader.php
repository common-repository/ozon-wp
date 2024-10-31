<?php


namespace Ipol\Ozon\Api\Entity\Common\Part;


use Ipol\Ozon\Api\Entity\AbstractEntity;

/**
 * Class TrackingHeader
 * @package Ipol\Ozon\Api
 * @subpackage Entity
 */
class TrackingHeader extends AbstractEntity
{
    /**
     * @var ApprovedDeliveryTime
     */
    protected $approvedDeliveryTime;
    /**
     * @var string (DateTime)
     */
    protected $estimateTimeArrival;
    /**
     * @var int
     */
    protected $storageDays;
    /**
     * @var string (DateTime)
     */
    protected $storageExpirationDate;

    /**
     * @return ApprovedDeliveryTime
     */
    public function getApprovedDeliveryTime()
    {
        return $this->approvedDeliveryTime;
    }

    /**
     * @param ApprovedDeliveryTime $approvedDeliveryTime
     * @return TrackingHeader
     */
    public function setApprovedDeliveryTime($approvedDeliveryTime)
    {
        $this->approvedDeliveryTime = $approvedDeliveryTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getEstimateTimeArrival(): string
    {
        return $this->estimateTimeArrival;
    }

    /**
     * @param string $estimateTimeArrival
     * @return TrackingHeader
     */
    public function setEstimateTimeArrival(string $estimateTimeArrival)
    {
        $this->estimateTimeArrival = $estimateTimeArrival;
        return $this;
    }

    /**
     * @return int
     */
    public function getStorageDays(): int
    {
        return $this->storageDays;
    }

    /**
     * @param int $storageDays
     * @return TrackingHeader
     */
    public function setStorageDays(int $storageDays)
    {
        $this->storageDays = $storageDays;
        return $this;
    }

    /**
     * @return string
     */
    public function getStorageExpirationDate(): string
    {
        return $this->storageExpirationDate;
    }

    /**
     * @param string $storageExpirationDate
     * @return TrackingHeader
     */
    public function setStorageExpirationDate(string $storageExpirationDate)
    {
        $this->storageExpirationDate = $storageExpirationDate;
        return $this;
    }

}