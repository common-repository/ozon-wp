<?php


namespace Ipol\Ozon\Ozon\Controller;


use Ipol\Ozon\Api\Entity\Request\ShipmentRequest as RequestObj;
use Ipol\Ozon\Ozon\Entity\ShipmentRequest as ResultObj;

/**
 * Class ShipmentRequest
 * @package Ipol\Ozon\Ozon
 * @subpakage Controller
 */
class ShipmentRequest extends AutomatedCommonRequest
{
    /**
     * ShipmentRequest constructor.
     * @param ResultObj $resultObj
     * @param int[] $orderIdArray
     */
    public function __construct(ResultObj $resultObj, array $orderIdArray)
    {
        parent::__construct($resultObj);
        $this->setRequestObj(new RequestObj($orderIdArray));
    }

}