<?php


namespace Ipol\Ozon\Ozon\Controller;

use Ipol\Ozon\Api\Entity\Request\DocumentList as RequestObj;
use Ipol\Ozon\Ozon\Entity\DocumentListResult as ResultObj;


/**
 * Class RequestDocumentList
 * @package Ipol\Ozon\Ozon\Controller
 */
class RequestDocumentList extends AutomatedCommonRequest
{
    /**
     * RequestManifestUnprocessed constructor.
     * @param ResultObj $resultObj
     * @param int|null $size
     * @param string|null $token
     * @param array $arFilter
     */
    public function __construct(ResultObj $resultObj, ?int $size = null, ?string $token = null, array $arFilter = [])
    {
        parent::__construct($resultObj);

        $data = new RequestObj();
        if($size)
            $data->setPaginationSize($size);
        if($token)
            $data->setPaginationToken($token);
        $data->setFields($arFilter);

        $this->setRequestObj($data);
    }

}