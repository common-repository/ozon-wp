<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\RejectedPostingList;

/**
 * Class ManifestUpload
 * @package Ipol\Ozon\Api\Entity\Response
 */
class ManifestUpload extends AbstractResponse
{
    /**
     * @var int
     */
    protected $total;
    /**
     * @var int
     */
    protected $accepted;
    /**
     * @var int
     */
    protected $rejected;
    /**
     * @var RejectedPostingList
     */
    protected $rejectedPostings;

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     * @return ManifestUpload
     */
    public function setTotal(int $total): ManifestUpload
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return int
     */
    public function getAccepted(): ?int
    {
        return $this->accepted;
    }

    /**
     * @param int $accepted
     * @return ManifestUpload
     */
    public function setAccepted(int $accepted): ManifestUpload
    {
        $this->accepted = $accepted;
        return $this;
    }

    /**
     * @return int
     */
    public function getRejected(): ?int
    {
        return $this->rejected;
    }

    /**
     * @param int $rejected
     * @return ManifestUpload
     */
    public function setRejected(int $rejected): ManifestUpload
    {
        $this->rejected = $rejected;
        return $this;
    }

    /**
     * @return RejectedPostingList
     */
    public function getRejectedPostings(): ?RejectedPostingList
    {
        return $this->rejectedPostings;
    }

    /**
     * @param array $array
     * @return ManifestUpload
     * @throws BadResponseException
     */
    public function setRejectedPostings(array $array): ManifestUpload
    {
        $collection = new RejectedPostingList();
        $this->rejectedPostings = $collection->fillFromArray($array);
        return $this;
    }

}