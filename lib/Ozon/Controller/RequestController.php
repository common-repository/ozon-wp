<?php


namespace Ipol\Ozon\Ozon\Controller;


use Ipol\Ozon\Api\Entity\Request\AbstractRequest;
use Ipol\Ozon\Api\Sdk;
use Ipol\Ozon\Ozon\AppLevelException;

/**
 * Class RequestController
 * @package Ipol\Ozon\Ozon\Controller
 */
abstract class RequestController
{
    /**
     * @var Sdk
     */
    protected $Sdk;
    /**
     * @var mixed|AbstractRequest
     */
    protected $requestObj;
    /**
     * @var string
     */
    protected $sdkMethodName;

    /**
     * @return $this|mixed
     */
    abstract public function execute();

    /**
     * @return mixed
     */
    public function getRequestObj()
    {
        return $this->requestObj;
    }

    /**
     * @param mixed $requestObj
     * @return $this|mixed
     */
    public function setRequestObj($requestObj)
    {
        $this->requestObj = $requestObj;
        return $this;
    }

    /**
     * @return Sdk|bool
     * @throws AppLevelException
     */
    public function getSdk()
    {
        if(!$this->Sdk)
            throw new AppLevelException('Accessing Sdk before setting and configuring it');
        return $this->Sdk;
    }

    /**
     * @param Sdk $Sdk
     * @return $this|mixed
     */
    public function setSdk(Sdk $Sdk)
    {
        $this->Sdk = $Sdk;

        return $this;
    }
    /**
     * @return string
     */
    public function getSdkMethodName(): string
    {
        return $this->sdkMethodName;
    }

    /**
     * @param string $sdkMethodName
     * @return $this|mixed
     */
    public function setSdkMethodName(string $sdkMethodName)
    {
        $this->sdkMethodName = $sdkMethodName;
        return $this;
    }

}