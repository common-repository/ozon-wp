<?php


namespace Ipol\Ozon\Ozon\Controller;


use Ipol\Ozon\Api\Entity\Request\OrderCancel as RequestObj;
use Ipol\Ozon\Ozon\Entity\CancelOrdersResult as ResultObj;

/**
 * Class CancelOrders
 * @package Ipol\Ozon\Application
 */
class CancelOrders extends AutomatedCommonRequest
{
    /**
     * OrderCancel constructor.
     * @param ResultObj $resultObj
     * @param array $arrOrderIds
     */
    public function __construct(ResultObj $resultObj, array $arrOrderIds)
    {
        parent::__construct($resultObj);
        $this->requestObj = new RequestObj($arrOrderIds);
    }

}