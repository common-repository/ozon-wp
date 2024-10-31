<?php


namespace Ipol\Ozon\Ozon\Controller;


use Ipol\Ozon\Api\Entity\Request\TrackingList as RequestObj;
use Ipol\Ozon\Ozon\Entity\TrackingListResult as ResultObj;

/**
 * Class RequestTrackingList
 * @package Ipol\Ozon\Ozon\Controller
 */
class RequestTrackingList extends AutomatedCommonRequest
{
    /**
     * RequestTrackingList constructor.
     * @param ResultObj $resultObj
     * @param string[] $arrArticles
     */
    public function __construct(ResultObj $resultObj, array $arrArticles)
    {
        parent::__construct($resultObj);

        $data = new RequestObj();
        $data->setArticles($arrArticles);

        $this->setRequestObj($data);
    }

}