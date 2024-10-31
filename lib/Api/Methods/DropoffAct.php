<?php


namespace Ipol\Ozon\Api\Methods;


use Ipol\Ozon\Api\Adapter\CurlAdapter;
use Ipol\Ozon\Api\ApiLevelException;
use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\EncoderInterface;
use Ipol\Ozon\Api\Entity\Response\ErrorResponse;
use Ipol\Ozon\Api\Entity\Response\DropoffAct as ObjResponse;

/**
 * Class DropoffAct
 * @package Ipol\Ozon\Api
 * @subpakage Methods
 * @method ObjResponse|ErrorResponse getResponse
 */
class DropoffAct extends AbstractMethod
{
    /**
     * DropoffAct constructor.
     * @param int $id
     * @param CurlAdapter $adapter
     * @param EncoderInterface|null $encoder
     * @throws BadResponseException
     */
    public function __construct(int $id, CurlAdapter $adapter, $encoder = null)
    {
        parent::__construct($adapter, $encoder);

        try {
            $this->setUrlImplement($this->encodeFieldToAPI('/'.$id.'/act'));
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