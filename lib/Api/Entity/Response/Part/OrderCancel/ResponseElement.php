<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\OrderCancel;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Response
 * @package Ipol\Ozon\Api
 * @subpackage Response
 */
class ResponseElement extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var null|ErrorList
     */
    protected $errors;
    /**
     * @var int
     */
    protected $id;
    /**
     * @var bool
     */
    protected $success;
    /**
     * @var null|Response
     */
    protected $response;

    /**
     * @return ErrorList|null
     */
    public function getErrors(): ?ErrorList
    {
        return $this->errors;
    }

    /**
     * @param array $array
     * @return ResponseElement
     * @throws BadResponseException
     */
    public function setErrors(array $array): ResponseElement
    {
        $collection = new ErrorList();
        $this->errors = $collection->fillFromArray($array);
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ResponseElement
     */
    public function setId(int $id): ResponseElement
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     * @return ResponseElement
     */
    public function setSuccess(bool $success): ResponseElement
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return Response|null
     */
    public function getResponse(): ?Response
    {
        return $this->response;
    }

    /**
     * @param array $response
     * @return ResponseElement
     */
    public function setResponse(array $response): ResponseElement
    {
        $this->response = new Response($response);
        return $this;
    }

}