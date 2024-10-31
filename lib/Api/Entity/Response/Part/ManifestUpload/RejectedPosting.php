<?php


namespace Ipol\Ozon\Api\Entity\Response\Part;


/**
 * Class RejectedPostings
 * @package Ipol\Ozon\Api\Entity\Response\Part
 */
class RejectedPosting extends \Ipol\Ozon\Api\Entity\AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var int
     */
    protected $postingNumber;
    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * @return int
     */
    public function getPostingNumber(): int
    {
        return $this->postingNumber;
    }

    /**
     * @param int $postingNumber
     * @return RejectedPosting
     */
    public function setPostingNumber(int $postingNumber): RejectedPosting
    {
        $this->postingNumber = $postingNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     * @return RejectedPosting
     */
    public function setErrorMessage(string $errorMessage): RejectedPosting
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

}