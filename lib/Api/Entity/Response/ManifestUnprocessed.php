<?php


namespace Ipol\Ozon\Api\Entity\Response;

use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\ManifestUnprocessed\DataList;


/**
 * Class ManifestUnprocessed
 * @package Ipol\Ozon\Api\Entity\Response
 */
class ManifestUnprocessed extends AbstractResponse
{
    /**
     * @var DataList
     */
    protected $data;
    /**
     * @var string|null
     */
    protected $nextPageToken;
    /**
     * @var int
     */
    protected $totalPostings;

    /**
     * @return DataList
     */
    public function getData(): DataList
    {
        return $this->data;
    }

    /**
     * @param array $array
     * @return ManifestUnprocessed
     * @throws BadResponseException
     */
    public function setData($array): ManifestUnprocessed
    {
        $collection = new DataList();
        $this->data = $collection->fillFromArray($array);
        return $this;
    }

    /**
     * @return string
     */
    public function getNextPageToken(): ?string
    {
        return $this->nextPageToken;
    }

    /**
     * @param string|null $nextPageToken
     * @return ManifestUnprocessed
     */
    public function setNextPageToken(?string $nextPageToken): ManifestUnprocessed
    {
        $this->nextPageToken = $nextPageToken;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPostings(): int
    {
        return $this->totalPostings;
    }

    /**
     * @param int $totalPostings
     * @return ManifestUnprocessed
     */
    public function setTotalPostings(int $totalPostings): ManifestUnprocessed
    {
        $this->totalPostings = $totalPostings;
        return $this;
    }

}