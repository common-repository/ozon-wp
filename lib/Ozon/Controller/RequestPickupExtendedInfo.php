<?php


namespace Ipol\Ozon\Ozon\Controller;


use Ipol\Ozon\Api\Entity\Request\PickupExtendedInfo as RequestObj;
use Ipol\Ozon\Ozon\Entity\PickupExtendedInfo as ResultObj;

/**
 * Class RequestPickupExtendedInfo
 * @package Ipol\Ozon\Ozon\Controller
 */
class RequestPickupExtendedInfo extends AutomatedCommonRequest
{
    /**
     * RequestPickupExtendedInfo constructor.
     * @param ResultObj $resultObj
     * @param int $delVarId
     */
    public function __construct(ResultObj $resultObj, int $delVarId)
    {
        parent::__construct($resultObj);

        $this->setRequestObj(new RequestObj($delVarId));
    }
}