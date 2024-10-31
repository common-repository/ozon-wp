<?php


namespace Ipol\Ozon\Api\Methods;

use Ipol\Ozon\Api\Adapter\CurlAdapter;
use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\EncoderInterface;
use Ipol\Ozon\Api\Entity\Request\DeliveryVariantsByViewport as ObjRequest;
use Ipol\Ozon\Api\Entity\Response\ErrorResponse;
use Ipol\Ozon\Api\Entity\Response\DeliveryVariantsByViewport as ObjResponse;


/**
 * Class DeliveryVariantsByViewport
 * @package Ipol\Ozon\Api
 * @subpakage Methods
 * @method ObjResponse|ErrorResponse getResponse
 */
class DeliveryVariantsByViewport extends GeneralMethod
{
    /**
     * DeliveryVariantsByViewport constructor.
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