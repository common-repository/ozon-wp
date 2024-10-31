<?php


namespace Ipol\Ozon\Api\Methods;


use Exception;
use Ipol\Ozon\Api\Adapter\CurlAdapter;
use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\EncoderInterface;
use Ipol\Ozon\Api\Entity\Request\DeliveryVariants as ObjRequest;
use Ipol\Ozon\Api\Entity\Response\DeliveryVariants as ObjResponse;
use Ipol\Ozon\Api\Entity\Response\ErrorResponse;

/**
 * Class DeliveryVariants
 * @package Ipol\Ozon\Api
 * @subpakage Methods
 * @method ObjResponse|ErrorResponse getResponse
 */
class DeliveryVariants extends GeneralMethod
{
    /**
     * DeliveryVariants constructor.
     * @param ObjRequest $data
     * @param CurlAdapter $adapter
     * @param EncoderInterface|null $encoder
     * @throws BadResponseException
     * @throws Exception
     */
    public function __construct(ObjRequest $data, CurlAdapter $adapter, $encoder = null)
    {
        parent::__construct($data, $adapter, ObjResponse::class, $encoder);
    }


}