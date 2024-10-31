<?php


namespace Ipol\Ozon\Ozon;


use Exception;
use Ipol\Ozon\Api\Entity\Response\ErrorResponse;

class ErrorResponseException extends Exception
{
    /**
     * ErrorResponseException constructor.
     * @param ErrorResponse $errorResponse
     */
    public function __construct(ErrorResponse $errorResponse)
    {
        parent::__construct($errorResponse->getMessage() . $errorResponse->getError(), $errorResponse->getHttpStatusCode());
    }
}