<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class TrackingByBarcode
 * @package Ipol\Ozon\Api\Entity\Request
 */
class TrackingByBarcode extends AbstractRequest
{
    /**
     * @var string
     */
    protected $postingBarcode;

    /**
     * TrackingByBarcode constructor.
     * @param string $postingBarcode
     */
    public function __construct(string $postingBarcode)
    {
        parent::__construct();
        $this->setPostingBarcode($postingBarcode);
    }

    /**
     * @return string
     */
    public function getPostingBarcode(): string
    {
        return $this->postingBarcode;
    }

    /**
     * @param string $postingBarcode
     * @return TrackingByBarcode
     */
    public function setPostingBarcode(string $postingBarcode): TrackingByBarcode
    {
        $this->postingBarcode = $postingBarcode;
        return $this;
    }

}