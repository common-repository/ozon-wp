<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class TokenGenerate
 * @package Ipol\Ozon\Api\Entity\Request
 */
class TokenGenerate extends AbstractRequest
{
    /**
     * @var string
     */
    protected $grant_type = 'client_credentials';
    /**
     * @var string
     */
    protected $client_id;
    /**
     * @var string
     */
    protected $client_secret;

    /**
     * @return string
     */
    public function getGrantType(): string
    {
        return $this->grant_type;
    }

    /**
     * @param string $grant_type
     * @return TokenGenerate
     */
    public function setGrantType(string $grant_type): TokenGenerate
    {
        $this->grant_type = $grant_type;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->client_id;
    }

    /**
     * @param string $client_id
     * @return TokenGenerate
     */
    public function setClientId(string $client_id): TokenGenerate
    {
        $this->client_id = $client_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    /**
     * @param string $client_secret
     * @return TokenGenerate
     */
    public function setClientSecret(string $client_secret): TokenGenerate
    {
        $this->client_secret = $client_secret;
        return $this;
    }

}