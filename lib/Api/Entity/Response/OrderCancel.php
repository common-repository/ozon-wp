<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\OrderCancel\ResponseElementList;

/**
 * Class OrderCancel
 * @package Ipol\Ozon\Api
 * @subpackage Response
 */
class OrderCancel extends AbstractResponse
{
    /**
     * @var ResponseElementList
     */
    protected $responses;

    /**
     * @return ResponseElementList
     */
    public function getResponses(): ResponseElementList
    {
        return $this->responses;
    }

    /**
     * @param array $array
     * @return OrderCancel
     * @throws BadResponseException
     */
    public function setResponses(array $array): OrderCancel
    {
        $collection = new ResponseElementList();
        $this->responses = $collection->fillFromArray($array);
        return $this;
    }
}