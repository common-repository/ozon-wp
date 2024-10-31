<?php


namespace Ipol\Ozon\Ozon\Controller;


use Ipol\Ozon\Api\Entity\Request\DeliveryTime;
use Ipol\Ozon\Ozon\Entity\DeliveryTimeResult as ResultObj;

/**
 * Class RequestDeliveryTime
 * @package Ipol\Ozon\Application
 */
class RequestDeliveryTime extends AutomatedCommonRequest
{
    /**
     * RequestDeliveryTime constructor.
     * @param ResultObj $resultObj
     * @param int $fromPlaceId
     * @param int $deliveryVariant
     */
    public function __construct(ResultObj $resultObj, int $fromPlaceId, int $deliveryVariant)
    {
        parent::__construct($resultObj);
        $this->requestObj = new DeliveryTime($fromPlaceId, $deliveryVariant);
    }

}