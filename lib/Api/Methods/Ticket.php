<?php


namespace Ipol\Ozon\Api\Methods;


use Ipol\Ozon\Api\Adapter\CurlAdapter;
use Ipol\Ozon\Api\ApiLevelException;
use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\EncoderInterface;
use Ipol\Ozon\Api\Entity\Response\ErrorResponse;
use Ipol\Ozon\Api\Entity\Response\Ticket as ObjResponse;

/**
 * Class Ticket
 * @package Ipol\Ozon\Api
 * @subpakage Methods
 * @method ObjResponse|ErrorResponse getResponse
 */
class Ticket extends AbstractMethod
{
    /**
     * Ticket constructor.
     * @param int[] $arrOrderIds
     * @param CurlAdapter $adapter
     * @param EncoderInterface|null $encoder
     * @throws BadResponseException
     */
    public function __construct(array $arrOrderIds, CurlAdapter $adapter, $encoder = null)
    {
        parent::__construct($adapter, $encoder);

        try {
            $tmpStr = '';
            foreach ($arrOrderIds as $orderId)
                $tmpStr .= '&orderId=' . $orderId;

            if($tmpStr)
                $tmpStr[0] = '?';

            $this->setUrlImplement($this->encodeFieldToAPI($tmpStr));
            $response = new ObjResponse($this->request());
            $response->setSuccess(true);
        } catch (ApiLevelException $e) {
            $response = new ErrorResponse($e);
            $response->setSuccess(false);
        }
        $this->setResponse($this->reEncodeResponse($response));

        $this->setFields();

    }
}