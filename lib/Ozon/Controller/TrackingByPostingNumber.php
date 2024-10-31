<?php


namespace Ipol\Ozon\Ozon\Controller;

use Ipol\Ozon\Api\Entity\Request\TrackingByPostingNumber as RequestObj;
use Ipol\Ozon\Ozon\Entity\TrackingResult as ResultObj;


/**
 * Class TrackingByPostingNumber
 * @package Ipol\Ozon\Ozon\Controller
 */
class TrackingByPostingNumber extends AutomatedCommonRequest
{
    /**
     * TrackingByPostingNumber constructor.
     * @param ResultObj $resultObj
     * @param string $number
     */
    public function __construct(ResultObj $resultObj, string $number)
    {
        parent::__construct($resultObj);

        $this->setRequestObj(new RequestObj($number));
    }

}