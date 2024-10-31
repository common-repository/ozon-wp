<?php


namespace Ipol\Ozon\Api\Methods;


use Ipol\Ozon\Api\Adapter\CurlAdapter;
use Ipol\Ozon\Api\ApiLevelException;
use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\EncoderInterface;
use Ipol\Ozon\Api\Entity\Request\TokenGenerate as ObjRequest;
use Ipol\Ozon\Api\Entity\Response\ErrorResponse;
use Ipol\Ozon\Api\Entity\Response\TokenGenerate as ObjResponse;

/**
 * Class TokenGenerate
 * @package Ipol\Ozon\Api
 * @subpakage Methods
 * @method ObjResponse|ErrorResponse getResponse
 */
class TokenGenerate extends AbstractMethod
{
    /**
     * TokenGenerate constructor.
     * @param ObjRequest $data
     * @param CurlAdapter $adapter
     * @param EncoderInterface|null $encoder
     * @throws BadResponseException
     */
    public function __construct(ObjRequest $data, CurlAdapter $adapter, $encoder = null)
    {
        parent::__construct($adapter, $encoder);

        try {
            $this->setDataPost($data->getFields());
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