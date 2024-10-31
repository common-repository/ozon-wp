<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\OrderCancel;


use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Error
 * @package Ipol\Ozon\Api
 * @subpackage Response
 */
class Error extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var string
     */
    protected $message;
    /**
     * @var string
     */
    protected $code;
    /**
     * @var string
     */
    protected $propertyName;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Error
     */
    public function setMessage(string $message): Error
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Error
     */
    public function setCode(string $code): Error
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    /**
     * @param string $propertyName
     * @return Error
     */
    public function setPropertyName(string $propertyName): Error
    {
        $this->propertyName = $propertyName;
        return $this;
    }

}