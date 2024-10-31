<?php


namespace Ipol\Ozon\Ozon\Entity;

use Ipol\Ozon\Api\Entity\Response\ErrorResponse;
use Ipol\Ozon\Api\Entity\Response\TokenGenerate as ResponseObj;

/**
 * Class RequestTokenResult
 * @package Ipol\Ozon\Application
 * @subpackage Result
 * @method ResponseObj|ErrorResponse getResponse
 */
class RequestTokenResult extends AbstractResult
{
    /**
     * @var string
     */
    protected $accessToken;
    /**
     * @var int - sec
     */
    protected $expiresIn;

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     * @return RequestTokenResult
     */
    public function setAccessToken(string $accessToken): RequestTokenResult
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    /**
     * @param int $expiresIn
     * @return RequestTokenResult
     */
    public function setExpiresIn(int $expiresIn): RequestTokenResult
    {
        $this->expiresIn = $expiresIn;
        return $this;
    }

    public function parseFields(): void
    {
        if($this->getResponse()) {
            $this->setAccessToken($this->getResponse()->getAccessToken())
                ->setExpiresIn($this->getResponse()->getExpiresIn());
        }
        parent::parseFields();
    }
}