<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class ManifestRemove
 * @package Ipol\Ozon\Api\Entity\Request
 */
class ManifestRemove extends AbstractRequest
{
    /**
     * @var string
     */
    protected $postingNumber;

    /**
     * @return string
     */
    public function getPostingNumber(): string
    {
        return $this->postingNumber;
    }

    /**
     * @param string $postingNumber
     * @return ManifestRemove
     */
    public function setPostingNumber(string $postingNumber): ManifestRemove
    {
        $this->postingNumber = $postingNumber;
        return $this;
    }
}