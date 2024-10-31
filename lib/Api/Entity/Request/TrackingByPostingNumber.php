<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class TrackingByPostingNumber
 * @package Ipol\Ozon\Api\Entity\Request
 */
class TrackingByPostingNumber extends AbstractRequest
{
    /**
     * @var string
     */
    protected $postingNumber;

    /**
     * TrackingByPostingNumber constructor.
     * @param string $postingNumber
     */
    public function __construct(string $postingNumber)
    {
        parent::__construct();
        $this->setPostingNumber($postingNumber);
    }

    /**
     * @return string
     */
    public function getPostingNumber(): string
    {
        return $this->postingNumber;
    }

    /**
     * @param string $postingNumber
     * @return TrackingByPostingNumber
     */
    public function setPostingNumber(string $postingNumber): TrackingByPostingNumber
    {
        $this->postingNumber = $postingNumber;
        return $this;
    }

}