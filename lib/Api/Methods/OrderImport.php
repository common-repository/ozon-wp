<?php


namespace Ipol\Ozon\Api\Methods;

use Ipol\Ozon\Api\Adapter\CurlAdapter;
use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\EncoderInterface;
use Ipol\Ozon\Api\Entity\Response\ErrorResponse;
use Ipol\Ozon\Api\Entity\Response\OrderImport as ObjResponse;


/**
 * Class OrderImport
 * @package Ipol\Ozon\Api
 * @subpakage Methods
 * @method ObjResponse|ErrorResponse getResponse
 */
class OrderImport extends GeneralMethod
{
    /**
     * OrderImport constructor.
     * @param CurlAdapter $adapter
     * @param EncoderInterface|null $encoder
     * @throws BadResponseException
     */
    public function __construct(CurlAdapter $adapter, $encoder = null)
    {
        parent::__construct(null, $adapter, ObjResponse::class, $encoder);
    }
}