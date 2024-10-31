<?php


namespace Ipol\Ozon\Ozon\Controller;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Request\TokenGenerate;
use Ipol\Ozon\Api\Entity\Response\ErrorResponse;
use Ipol\Ozon\Ozon\AppLevelException;
use Ipol\Ozon\Ozon\Entity\RequestTokenResult;
use Ipol\Ozon\Ozon\ErrorResponseException;

/**
 * Class RequestToken
 * @package Ipol\Ozon\Ozon\Controller
 */
class RequestToken extends RequestController
{
    /**
     * RequestToken constructor.
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct(string $clientId, string $clientSecret)
    {
        $data = new TokenGenerate();
        $data->setClientId($clientId)
        ->setClientSecret($clientSecret);

        $this->setRequestObj($data);
    }

    /**
     * @return RequestTokenResult
     */
    public function execute(): RequestTokenResult
    {
        $result = new RequestTokenResult();

        try{
            $request = $this->getSdk()
                ->tokenGenerate($this->getRequestObj());

            $result->setSuccess($request->getResponse()->getSuccess())
                ->setResponse($request->getResponse());
            if(!$result->isSuccess())
            {
                if(is_a($request->getResponse(), ErrorResponse::class))
                    $result->setError(new ErrorResponseException($request->getResponse()));
            }
            else
            {
                $result->parseFields();
            }
        }catch(BadResponseException | AppLevelException $e){
            $result->setSuccess(false)
                ->setError($e);
        } finally {
            return $result;
        }
    }

}