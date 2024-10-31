<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\ApiLevelException;
use Ipol\Ozon\Api\BadResponseException;

/**
 * Class ErrorResponse
 * @package Ipol\Ozon\Api\Entity\Response
 */
class ErrorResponse extends AbstractResponse
{
    /**
     * @var string
     */
    protected $message;
    /**
     * @var string
     */
    protected $errorCode;
    /**
     * @var array|null
     */
    protected $arguments;
    /**
     * @var
     */
    protected $extensions;
    /**
     * @var integer
     */
    protected $httpStatusCode;
    /**
     * @var string
     */
    protected $x_o3_trace_id = '';

    /**
     * ErrorResponse constructor.
     * @param ApiLevelException $apiException
     * @throws BadResponseException
     */
    public function __construct(ApiLevelException $apiException)
    {
        $answer = $apiException->getAnswer();
        $this->errorCode = $apiException->getCode();
        parent::__construct($answer); //jump to BadServerAnswerException if json-answer is damaged/empty
        $this->x_o3_trace_id = $apiException->getHeader('x-o3-trace-id');
    }

    /**
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return ErrorResponse
     */
    public function setMessage(string $message): ErrorResponse
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string|int|null
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param string|int $errorCode
     * @return ErrorResponse
     */
    public function setErrorCode($errorCode): ErrorResponse
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @return array
     */
    public function getArguments(): ?array
    {
        return $this->arguments;
    }

    /**
     * @param array|null $arguments
     * @return ErrorResponse
     */
    public function setArguments(?array $arguments): ErrorResponse
    {
        $this->arguments = $arguments;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * @param mixed $extensions
     * @return ErrorResponse
     */
    public function setExtensions($extensions)
    {
        $this->extensions = $extensions;
        return $this;
    }

    /**
     * @return int
     */
    public function getHttpStatusCode(): ?int
    {
        return $this->httpStatusCode;
    }

    /**
     * @param int $httpStatusCode
     * @return ErrorResponse
     */
    public function setHttpStatusCode(int $httpStatusCode): ErrorResponse
    {
        $this->httpStatusCode = $httpStatusCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getXO3TraceId(): string
    {
        return $this->x_o3_trace_id;
    }

}