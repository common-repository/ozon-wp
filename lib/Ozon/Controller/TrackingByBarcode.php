<?php


namespace Ipol\Ozon\Ozon\Controller;


use Ipol\Ozon\Api\Entity\Request\TrackingByBarcode as RequestObj;
use Ipol\Ozon\Ozon\Entity\TrackingResult as ResultObj;

/**
 * Class TrackingByBarcode
 * @package Ipol\Ozon\Ozon\Controller
 */
class TrackingByBarcode extends AutomatedCommonRequest
{
    /**
     * TrackingByBarcode constructor.
     * @param ResultObj $resultObj
     * @param string $barcode
     */
    public function __construct(ResultObj $resultObj, string $barcode)
    {
        parent::__construct($resultObj);

        $this->setRequestObj(new RequestObj($barcode));
    }

}