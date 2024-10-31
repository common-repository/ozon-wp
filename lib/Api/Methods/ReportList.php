<?php


namespace Ipol\Ozon\Api\Methods;


use Ipol\Ozon\Api\Adapter\CurlAdapter;
use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\EncoderInterface;
use Ipol\Ozon\Api\Entity\Request\ReportList as ObjRequest;
use Ipol\Ozon\Api\Entity\Response\ReportList as ObjResponse;
use Ipol\Ozon\Api\Entity\Response\ErrorResponse;

/**
 * Class ReportList
 * @package Ipol\Ozon\Api
 * @subpakage Methods
 * @method ObjResponse|ErrorResponse getResponse
 */
class ReportList extends GeneralMethod
{
    /**
     * ReportList constructor.
     * @param ObjRequest $data
     * @param CurlAdapter $adapter
     * @param EncoderInterface|null $encoder
     * @throws BadResponseException
     */
    public function __construct(ObjRequest $data, CurlAdapter $adapter, $encoder = null)
    {
        parent::__construct($data, $adapter, ObjResponse::class, $encoder);
    }
}