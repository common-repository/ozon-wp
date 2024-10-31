<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\TrackingByPostingNumber;


use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Item
 * @package Ipol\Ozon\Api\Entity\Response\Part\TrackingByPostingNumber
 */
class Item extends \Ipol\Ozon\Api\Entity\Common\Part\Item
{
    use AbstractResponsePart;

    /**
     * @var string
     */
    protected $externalPostingUrl;

    /**
     * @return string
     */
    public function getExternalPostingUrl(): string
    {
        return $this->externalPostingUrl;
    }

    /**
     * @param string $externalPostingUrl
     * @return Item
     */
    public function setExternalPostingUrl(string $externalPostingUrl): Item
    {
        $this->externalPostingUrl = $externalPostingUrl;
        return $this;
    }

}