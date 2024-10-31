<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class TrackingPosting
 * @package Ipol\Ozon\Api\Entity\Request
 */
class TrackingPosting extends AbstractRequest
{
    /**
     * @var string
     */
    protected $postingBarcode;

    /**
     * TrackingPosting constructor.
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
     * @return TrackingPosting
     */
    public function setPostingBarcode(string $postingBarcode): TrackingPosting
    {
        $this->postingBarcode = $postingBarcode;
        return $this;
    }

}