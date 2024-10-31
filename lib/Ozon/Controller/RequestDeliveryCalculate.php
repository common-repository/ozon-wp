<?php
namespace Ipol\Ozon\Ozon\Controller;

use Ipol\Ozon\Api\Entity\Request\DeliveryCalculate as RequestObj;
use Ipol\Ozon\Ozon\Entity\DeliveryCalculate as ResultObj;

/**
 * Class RequestDeliveryCalculate
 * @package Ipol\Ozon\Ozon\Controller
 */
class RequestDeliveryCalculate extends AutomatedCommonRequest
{
    /**
     * RequestDeliveryCalculate constructor.
     * @param ResultObj $resultObj
     * @param int $deliveryVariantId
     * @param float $weight
     * @param int $fromPlaceId
     * @param float $estimatedPrice
     */
    public function __construct(ResultObj $resultObj, int $deliveryVariantId, float $weight, int $fromPlaceId, float $estimatedPrice)
    {
        parent::__construct($resultObj);

        $data = new RequestObj();
        $data->setFromPlaceId($fromPlaceId)
            ->setDeliveryVariantId($deliveryVariantId)
            ->setWeight($weight)
            ->setEstimatedPrice($estimatedPrice);

        $this->setRequestObj($data);
    }

}