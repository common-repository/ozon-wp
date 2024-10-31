<?php


namespace Ipol\Ozon\Api;


use Exception;
use Ipol\Ozon\Api\Adapter\ResponseHeadersTrait;

class BadResponseException extends Exception
{
    use ResponseHeadersTrait;

    public function __construct($message = "", $code = 0, array $responseHeaders = [])
    {
        parent::__construct($message, $code);
        $this->setHeaders($responseHeaders);
    }
}