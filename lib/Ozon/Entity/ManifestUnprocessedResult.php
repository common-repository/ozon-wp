<?php


namespace Ipol\Ozon\Ozon\Entity;


use Ipol\Ozon\Api\Entity\Response\ErrorResponse;
use Ipol\Ozon\Api\Entity\Response\ManifestUnprocessed as ResponseObj;

/**
 * Class ManifestUnprocessedResult
 * @package Ipol\Ozon\Application
 * @subpackage Result
 * @method ResponseObj|ErrorResponse getResponse
 */
class ManifestUnprocessedResult extends AbstractResult
{
    /**
     * @var null|string
     */
    protected $nextPageToken;

    public function parseFields(): void
    {
        if($this->getResponse()) {
            $this->setNextPageToken($this->getResponse()->getNextPageToken());
        }
        parent::parseFields();
    }

    /**
     * @return string|null
     */
    public function getNextPageToken(): ?string
    {
        return $this->nextPageToken;
    }

    /**
     * @param string|null $nextPageToken
     * @return $this
     */
    public function setNextPageToken(?string $nextPageToken): ManifestUnprocessedResult
    {
        $this->nextPageToken = $nextPageToken;
        return $this;
    }
}