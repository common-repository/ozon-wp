<?php


namespace Ipol\Ozon\Ozon\Controller;

use Ipol\Ozon\Api\Entity\Request\Document as RequestObj;
use Ipol\Ozon\Ozon\Entity\GetDocumentResult as ResultObj;


/**
 * Class RequestDocument
 * @package Ipol\Ozon\Ozon\Controller
 */
class RequestDocument extends AutomatedCommonRequest
{
    /**
     * RequestDocument constructor.
     * @param ResultObj $resultObj
     * @param int $documentId
     * @param string $documentType
     * @param string $documentFormat
     */
    public function __construct(ResultObj $resultObj, int $documentId, string $documentType, string $documentFormat)
    {
        parent::__construct($resultObj);

        $data = new RequestObj();
        $data->setId($documentId)
            ->setType($documentType)
            ->setFormat($documentFormat);

        $this->setRequestObj($data);
    }

}