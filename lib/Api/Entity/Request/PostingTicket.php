<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class PostingTicket
 * @package Ipol\Ozon\Api\Entity\Request
 */
class PostingTicket extends AbstractRequest
{
    /**
     * @var integer
     */
    protected $postingId;

    /**
     * @return int
     */
    public function getPostingId(): int
    {
        return $this->postingId;
    }

    /**
     * @param int $postingId
     * @return PostingTicket
     */
    public function setPostingId(int $postingId): PostingTicket
    {
        $this->postingId = $postingId;
        return $this;
    }

}