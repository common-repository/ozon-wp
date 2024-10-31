<?php


namespace Ipol\Ozon\Api\Entity\Response;


/**
 * Class TokenGenerate
 * @package Ipol\Ozon\Api\Entity\Response
 */
class TokenGenerate extends AbstractResponse
{
    /**
     * @var string
     */
    protected $access_token;
    /**
     * @var int
     */
    protected $expires_in;
    /**
     * @var string
     */
    protected $token_type;
    /**
     * @var string
     */
    protected $scope;

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @param string $access_token
     * @return TokenGenerate
     */
    public function setAccessToken(string $access_token): TokenGenerate
    {
        $this->access_token = $access_token;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expires_in;
    }

    /**
     * @param int $expires_in
     * @return TokenGenerate
     */
    public function setExpiresIn(int $expires_in): TokenGenerate
    {
        $this->expires_in = $expires_in;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->token_type;
    }

    /**
     * @param string $token_type
     * @return TokenGenerate
     */
    public function setTokenType(string $token_type): TokenGenerate
    {
        $this->token_type = $token_type;
        return $this;
    }

    /**
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     * @return TokenGenerate
     */
    public function setScope(string $scope): TokenGenerate
    {
        $this->scope = $scope;
        return $this;
    }

}