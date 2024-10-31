<?php


namespace Ipol\Ozon\Api\Methods;


use Ipol\Ozon\Api\Adapter\CurlAdapter;
use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\EncoderInterface;
use Ipol\Ozon\Api\Entity\Response\DeliveryFromPlaces as ObjResponse;
use Ipol\Ozon\Api\Entity\Response\ErrorResponse;

/**
 * Class DeliveryFromPlaces
 * @package Ipol\Ozon\Api
 * @subpakage Methods
 * @method ObjResponse|ErrorResponse getResponse
 */
class DeliveryFromPlaces extends GeneralMethod
{
    /**
     * DeliveryFromPlaces constructor.
     * @param CurlAdapter $adapter
     * @param EncoderInterface|null $encoder
     * @throws BadResponseException
     */
    public function __construct(CurlAdapter $adapter, $encoder = null)
    {
        parent::__construct(null, $adapter, ObjResponse::class, $encoder);
    }
}