<?php


namespace Ipol\Ozon\Api\Methods;


use Ipol\Ozon\Api\Adapter\CurlAdapter;
use Ipol\Ozon\Api\ApiLevelException;
use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\EncoderInterface;
use Ipol\Ozon\Api\Entity\Request\AbstractRequest;
use Ipol\Ozon\Api\Entity\Response\AbstractResponse;
use Ipol\Ozon\Api\Entity\Response\ErrorResponse;

/**
 * Class GeneralMethod
 * @package Ipol\Ozon\Api
 * @subpakage Methods
 * @method AbstractResponse|mixed|ErrorResponse getResponse
 */
class GeneralMethod extends AbstractMethod
{
    /**
     * GeneralMethod constructor.
     * @param AbstractRequest|mixed|null $data
     * @param CurlAdapter $adapter
     * @param string $responseClass
     * @param EncoderInterface|mixed|null $encoder
     * @throws BadResponseException
     */
    public function __construct($data, CurlAdapter $adapter, string $responseClass, $encoder = null)
    {
        parent::__construct($adapter, $encoder);

        if(!is_null($data)) {
            $this->setData($this->getEntityFields($data));
        }

        try {
            $response = new $responseClass($this->request());
            $response->setSuccess(true);
        } catch (ApiLevelException $e) {
            $response = new ErrorResponse($e);
            $response->setSuccess(false);
        }
        $this->setResponse($this->reEncodeResponse($response));
        $this->setFields();
    }

}