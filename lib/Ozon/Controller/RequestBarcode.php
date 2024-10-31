<?php


namespace Ipol\Ozon\Ozon\Controller;


use Ipol\Ozon\Api\Entity\Request\PostingTicket;
use Ipol\Ozon\Ozon\Entity\GetBarcodeResult as ResultObj;

/**
 * Class RequestBarcode
 * @package Ipol\Ozon\Application
 */
class RequestBarcode extends AutomatedCommonRequest
{
    /**
     * RequestBarcode constructor.
     * @param ResultObj $resultObj
     * @param int $postingId
     */
    public function __construct(ResultObj $resultObj, int $postingId)
    {
        parent::__construct($resultObj);

        $data = new PostingTicket();
        $data->setPostingId($postingId);

        $this->setRequestObj($data);
    }
}