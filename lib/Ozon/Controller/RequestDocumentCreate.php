<?php


namespace Ipol\Ozon\Ozon\Controller;

use Ipol\Ozon\Api\Entity\Request\DocumentCreate as RequestObj;
use Ipol\Ozon\Ozon\Entity\DocumentCreateResult as ResultObj;


/**
 * Class RequestDocumentCreate
 * @package Ipol\Ozon\Ozon\Controller
 */
class RequestDocumentCreate extends AutomatedCommonRequest
{
    /**
     * RequestDocumentCreate constructor.
     * @param ResultObj $resultObj
     * @param array $arrId
     */
    public function __construct(ResultObj $resultObj, array $arrId)
    {
        parent::__construct($resultObj);

        $data = new RequestObj();
        $data->setPostingIds($arrId);

        $this->setRequestObj($data);
    }

}