<?php


namespace Ipol\Ozon\Ozon\Controller;


use Ipol\Ozon\Api\Entity\Request\TrackingPosting as RequestObj;
use Ipol\Ozon\Ozon\Entity\TrackingDetailResult as ResultObj;

/**
 * Class TrackingDetail
 * @package Ipol\Ozon\Ozon\Controller
 */
class TrackingDetail extends AutomatedCommonRequest
{
    /**
     * TrackingDetail constructor.
     * @param ResultObj $resultObj
     * @param string $barcode
     */
    public function __construct(ResultObj $resultObj, string $barcode)
    {
        parent::__construct($resultObj);

        $this->setRequestObj(new RequestObj($barcode));
    }

}