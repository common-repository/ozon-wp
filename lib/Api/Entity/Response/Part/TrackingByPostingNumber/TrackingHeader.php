<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\TrackingByPostingNumber;


use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class TrackingHeader
 * @package Ipol\Ozon\Api\Entity\Response\Part\TrackingByPostingNumber
 */
class TrackingHeader extends \Ipol\Ozon\Api\Entity\Common\Part\TrackingHeader
{
    use AbstractResponsePart;

    /**
     * @var ApprovedDeliveryTime
     */
    protected $approvedDeliveryTime;

    /**
     * @return ApprovedDeliveryTime
     */
    public function getApprovedDeliveryTime(): ApprovedDeliveryTime
    {
        return $this->approvedDeliveryTime;
    }

    /**
     * @param mixed $approvedDeliveryTime - supposedly, array
     * @return TrackingHeader
     */
    public function setApprovedDeliveryTime($approvedDeliveryTime): TrackingHeader
    {
        $this->approvedDeliveryTime = new ApprovedDeliveryTime($approvedDeliveryTime);
        return $this;
    }


}