<?php


namespace Ipol\Ozon\Ozon\Entity;


use Ipol\Ozon\Api\Entity\Response\DeliveryVariants as ResponseObj;
use Ipol\Ozon\Api\Entity\Response\ErrorResponse;

/**
 * Class DeliveryVariantsResult
 * @package Ipol\Ozon\Application
 * @subpackage Result
 * @method ResponseObj|ErrorResponse getResponse
 */
class DeliveryVariantsResult extends AbstractResult
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
     * @return DeliveryVariantsResult
     */
    public function setNextPageToken(?string $nextPageToken): DeliveryVariantsResult
    {
        $this->nextPageToken = $nextPageToken;
        return $this;
    }


}